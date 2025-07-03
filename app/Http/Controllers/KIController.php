<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KIController extends Controller
{
    public function index()
    {
        return view('ki.dashboard');
    }
}

