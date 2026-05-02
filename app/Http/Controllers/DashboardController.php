<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\Interview;
use App\Models\JobMatch;
use App\Models\OptimizedCV;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $cvs = CV::where('user_id', $userId)->latest()->get();
        $interviews = Interview::where('user_id', $userId)->latest()->get();
        $matches = JobMatch::where('user_id', $userId)->latest()->take(5)->get();
        $optimizedCVs = OptimizedCV::where('user_id', $userId)->latest()->take(5)->get();

        $avgScore = Interview::where('user_id', $userId)->avg('score');

        return view('dashboard.index', compact(
            'cvs',
            'interviews',
            'matches',
            'optimizedCVs',
            'avgScore'
        ));
    }
}