<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CV;

class CVController extends Controller
{
    public function index()
    {
        return view('cv.index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $path = $request->file('cv')->store('cvs');

        CV::create([
            'user_id' => auth()->id(),
            'file_path' => $path
        ]);

        return redirect()->back()->with('success', 'CV uploaded successfully');
    }
}