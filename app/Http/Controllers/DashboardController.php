<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\Interview;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $cvs = CV::where('user_id', $userId)->latest()->get();
        $interviews = Interview::where('user_id', $userId)->latest()->get();

        $avgScore = Interview::where('user_id', $userId)->avg('score');

        return view('dashboard.index', compact(
            'cvs',
            'interviews',
            'avgScore'
        ));
    }
}