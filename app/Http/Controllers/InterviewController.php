<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\CV;
use App\Services\AIService;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Log;

class InterviewController extends Controller
{
    public function index()
    {
        $cvs = CV::where('user_id', auth()->id())->latest()->get();
        $interviews = Interview::where('user_id', auth()->id())
            ->with('cv')
            ->latest()
            ->take(20)
            ->get();

        // Calculer les statistiques
        $totalInterviews = Interview::where('user_id', auth()->id())->count();
        $avgScore = Interview::where('user_id', auth()->id())->avg('score') ?? 0;
        $bestScore = Interview::where('user_id', auth()->id())->max('score') ?? 0;

        return view('interview.index', compact('cvs', 'interviews', 'totalInterviews', 'avgScore', 'bestScore'));
    }

    public function start(Request $request, AIService $ai)
    {
        if (!$request->has('cv_id')) {
            $cvs = CV::where('user_id', auth()->id())->latest()->get();
            return view('interview.select', compact('cvs'));
        }

        $request->validate([
            'cv_id' => 'required|exists:cvs,id'
        ]);

        $cv = CV::findOrFail($request->cv_id);
        
        if ($cv->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'CV non autorisé');
        }

        // Extraire le texte du CV
        $fullPath = storage_path('app/public/' . $cv->file_path);
        $parser = new Parser();
        $pdf = $parser->parseFile($fullPath);
        $cvText = $pdf->getText();
        $cvText = mb_convert_encoding($cvText, 'UTF-8', 'auto');
        $cvText = substr($cvText, 0, 8000);

        if (strlen(trim($cvText)) < 50) {
            return redirect()->back()->with('error', '❌ Impossible d\'extraire le texte du CV. Vérifiez le format du PDF.');
        }

        // Générer la première question
        $question = $ai->generateQuestion($cvText);

        // Nettoyer la question
        $question = trim($question);
        $question = preg_replace('/^(Bonjour|Merci|Hello)[.,\s]*/i', '', $question);
        $question = preg_replace('/^\*+|\*+$/', '', $question);

        if (empty($question) || strlen($question) < 30 || str_contains($question, 'AI Error')) {
            Log::error('Interview question generation failed', [
                'cv_text_length' => strlen($cvText),
                'question' => $question
            ]);
            return redirect()->back()->with('error', '❌ Erreur lors de la génération de la question. Réessayez.');
        }

        // Stocker dans la session
        session([
            'interview_cv_id' => $cv->id,
            'interview_cv_text' => $cvText,
            'interview_questions' => [],
            'interview_number' => 1
        ]);

        return view('interview.chat', compact('question', 'cv'));
    }

    public function submit(Request $request, AIService $ai)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required|min:10'
        ]);

        $feedback = $ai->evaluateAnswer(
            $request->question,
            $request->answer
        );

        // Extraction du score
        preg_match('/(\d+)\/10/', $feedback, $matches);
        $score = $matches[1] ?? 0;

        // Sauvegarder l'interview
        $interview = Interview::create([
            'user_id' => auth()->id(),
            'cv_id' => session('interview_cv_id'),
            'question' => $request->question,
            'answer' => $request->answer,
            'feedback' => $feedback,
            'score' => $score
        ]);

        // Ajouter à l'historique de session
        $questions = session('interview_questions', []);
        $questions[] = [
            'id' => $interview->id,
            'question' => $request->question,
            'answer' => $request->answer,
            'feedback' => $feedback,
            'score' => $score
        ];
        session(['interview_questions' => $questions]);

        // Générer la prochaine question si demandé
        if ($request->has('continue')) {
            $interviewNumber = session('interview_number', 1) + 1;
            session(['interview_number' => $interviewNumber]);

            // Limiter à 10 questions max
            if ($interviewNumber > 10) {
                return redirect('/interview')->with('success', '🎉 Interview terminée ! Vous avez répondu à 10 questions.');
            }

            $nextQuestion = $ai->generateQuestion(session('interview_cv_text'));
            
            // Nettoyer la question
            $nextQuestion = trim($nextQuestion);
            $nextQuestion = preg_replace('/^(Bonjour|Merci|Hello)[.,\s]*/i', '', $nextQuestion);
            $nextQuestion = preg_replace('/^\*+|\*+$/', '', $nextQuestion);
            
            if (empty($nextQuestion) || strlen($nextQuestion) < 30) {
                return redirect('/interview')->with('success', 'Interview terminée avec succès!');
            }
            
            return view('interview.chat', [
                'question' => $nextQuestion,
                'history' => $questions,
                'cv' => CV::find(session('interview_cv_id')),
                'questionNumber' => $interviewNumber
            ]);
        }

        return redirect('/interview')->with('success', '✅ Interview terminée avec succès!');
    }
}