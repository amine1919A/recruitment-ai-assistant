<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;
use App\Models\JobMatch;
use App\Services\AIService;
use Smalot\PdfParser\Parser;

class JobMatchController extends Controller
{
    public function index()
    {
        $cvs = CV::where('user_id', auth()->id())->latest()->get();
        $matches = JobMatch::where('user_id', auth()->id())
            ->with('cv')
            ->latest()
            ->get();

        return view('match.index', compact('cvs', 'matches'));
    }

    public function match(Request $request, AIService $ai)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'job_description' => 'required|min:50'
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
        $cvText = substr($cvText, 0, 10000);

        // Analyser la compatibilité
        $result = $ai->matchJob($cvText, $request->job_description);

        // Sauvegarder le match
        $match = JobMatch::create([
            'user_id' => auth()->id(),
            'cv_id' => $cv->id,
            'job_description' => $request->job_description,
            'match_result' => $result
        ]);

        return view('match.result', compact('result', 'cv', 'match'));
    }
}