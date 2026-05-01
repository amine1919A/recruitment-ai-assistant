<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\CV;
use App\Services\AIService;
class CVController extends Controller
{
    public function index()
    {
        return view('cv.index');
    }

    public function upload(Request $request, AIService $ai)
{
    $request->validate([
        'cv' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);

    $path = $request->file('cv')->store('cvs');

    // ⚠️ extraction simple (version débutant)
    $text = file_get_contents(storage_path("app/".$path));

    // 🤖 appel IA
    $analysis = $ai->analyzeCV($text);

    $cv = CV::create([
        'user_id' => auth()->id(),
        'file_path' => $path,
        'analysis' => $analysis
    ]);

    return view('cv.result', compact('cv', 'analysis'));
}
}