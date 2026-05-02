<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;
use App\Services\AIService;
use App\Mail\CVResultMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser;

class CVController extends Controller
{
    public function index()
    {
        // ✅ RÉCUPÉRER TOUS LES CV DE L'UTILISATEUR
        $cvs = CV::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cv.index', compact('cvs'));
    }

    public function upload(Request $request, AIService $ai)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048'
        ]);

        try {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'public');

            $fullPath = storage_path('app/public/' . $path);

            if (!file_exists($fullPath)) {
                return back()->with('error', 'Fichier introuvable');
            }

            $parser = new Parser();
            $pdf = $parser->parseFile($fullPath);

            $text = $pdf->getText();
            $text = mb_convert_encoding($text, 'UTF-8', 'auto');
            $text = preg_replace('/[^\P{C}\n]+/u', '', $text);
            $text = substr($text, 0, 8000);

            $analysis = $ai->analyzeCV($text);

            if (
                empty($analysis) ||
                str_contains($analysis, 'AI Error') ||
                str_contains($analysis, 'quota') ||
                str_contains($analysis, '429') ||
                strlen($analysis) < 80
            ) {
                Log::warning('CV AI failed for user ' . auth()->id());
                return back()->with('error', '❌ IA temporairement indisponible. Réessayez dans quelques minutes.');
            }

            $cv = CV::create([
                'user_id' => auth()->id(),
                'file_path' => $path,
                'analysis' => $analysis
            ]);

            try {
                Mail::to(auth()->user()->email)
                    ->send(new CVResultMail($analysis));
            } catch (\Exception $e) {
                Log::error('Email failed: ' . $e->getMessage());
            }

            return redirect()->route('cv.index')->with('success', '✅ CV analysé avec succès!');

        } catch (\Exception $e) {
            Log::error('CV Upload Error: ' . $e->getMessage());
            return back()->with('error', '❌ Erreur serveur, veuillez réessayer.');
        }
    }

    // ✅ NOUVELLE MÉTHODE POUR VOIR UNE ANALYSE
    public function show($id)
    {
        $cv = CV::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $analysis = $cv->analysis;

        return view('cv.result', compact('cv', 'analysis'));
    }

    public function destroy($id)
    {
        $cv = CV::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($cv->file_path && file_exists(storage_path('app/public/' . $cv->file_path))) {
            unlink(storage_path('app/public/' . $cv->file_path));
        }

        $cv->delete();

        return back()->with('success', '🗑 Analyse supprimée avec succès.');
    }
}