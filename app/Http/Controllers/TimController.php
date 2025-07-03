<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimController extends Controller
{
    public function index()
    {
        return view('tim.dashboard');
    }
}

