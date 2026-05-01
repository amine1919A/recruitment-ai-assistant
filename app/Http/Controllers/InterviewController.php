<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use App\Services\AIService;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::where('user_id', auth()->id())->latest()->get();

        return view('interview.index', compact('interviews'));
    }

    public function start(AIService $ai)
    {
        $cvText = "exemple cv utilisateur"; // plus tard lié CV DB

        $question = $ai->generateQuestion($cvText);

        return view('interview.chat', compact('question'));
    }

    public function submit(Request $request, AIService $ai)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $feedback = $ai->evaluateAnswer(
            $request->question,
            $request->answer
        );

        // score extraction simple
        preg_match('/\d+/', $feedback, $matches);
        $score = $matches[0] ?? 0;

        Interview::create([
            'user_id' => auth()->id(),
            'question' => $request->question,
            'answer' => $request->answer,
            'feedback' => $feedback,
            'score' => $score
        ]);

        return redirect('/interview');
    }
}