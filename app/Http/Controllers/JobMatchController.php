<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIService;

class JobMatchController extends Controller
{
    public function index()
    {
        return view('match.index');
    }

    public function match(Request $request, AIService $ai)
    {
        $result = $ai->matchJob(
            $request->cv,
            $request->job
        );

        return view('match.result', compact('result'));
    }
}