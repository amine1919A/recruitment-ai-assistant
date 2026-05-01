<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;
use App\Services\AIService;
use App\Mail\CVResultMail;
use Illuminate\Support\Facades\Mail;
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

        $text = file_get_contents(storage_path("app/".$path));

        $analysis = $ai->analyzeCV($text);

        $cv = CV::create([
            'user_id' => auth()->id(),
            'file_path' => $path,
            'analysis' => $analysis
        ]);
        Mail::to(auth()->user()->email)
        ->send(new CVResultMail($analysis));

        return view('cv.result', compact('cv', 'analysis'));
    }
}