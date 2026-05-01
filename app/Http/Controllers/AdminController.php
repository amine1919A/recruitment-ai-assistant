<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CV;
use App\Models\Interview;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cvs = CV::latest()->get();
        $interviews = Interview::latest()->get();

        return view('admin.index', compact('users','cvs','interviews'));
    }
}