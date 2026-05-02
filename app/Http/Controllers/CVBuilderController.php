<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;
use App\Models\OptimizedCV;
use App\Services\AIService;
use Smalot\PdfParser\Parser;

class CVBuilderController extends Controller
{
    public function index()
    {
        $cvs = CV::where('user_id', auth()->id())->latest()->get();
        $optimizedCVs = OptimizedCV::where('user_id', auth()->id())
            ->with('cv')
            ->latest()
            ->get();

        return view('cvbuilder.index', compact('cvs', 'optimizedCVs'));
    }

    public function create()
    {
        $cvs = CV::where('user_id', auth()->id())->latest()->get();
        return view('cvbuilder.create', compact('cvs'));
    }

    public function generate(Request $request, AIService $ai)
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

        // Générer le CV optimisé
        $optimizedContent = $ai->generateOptimizedCV($cvText, $request->job_description);

        // Sauvegarder
        $optimizedCV = OptimizedCV::create([
            'user_id' => auth()->id(),
            'cv_id' => $cv->id,
            'job_description' => $request->job_description,
            'optimized_content' => $optimizedContent
        ]);

        return view('cvbuilder.result', compact('optimizedCV', 'optimizedContent'));
    }

    public function edit($id)
    {
        $optimizedCV = OptimizedCV::findOrFail($id);
        
        if ($optimizedCV->user_id !== auth()->id()) {
            abort(403);
        }

        return view('cvbuilder.edit', compact('optimizedCV'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'optimized_content' => 'required|min:100'  // ✅ CORRECTION ICI
        ]);

        $optimizedCV = OptimizedCV::findOrFail($id);
        
        if ($optimizedCV->user_id !== auth()->id()) {
            abort(403);
        }

        $optimizedCV->update([
            'optimized_content' => $request->optimized_content  // ✅ CORRECTION ICI
        ]);

        return redirect()->route('cvbuilder.index')
            ->with('success', 'CV optimisé mis à jour!');
    }
}