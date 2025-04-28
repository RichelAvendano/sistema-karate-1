<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DojoController extends Controller
{
    public function index()
    {
        return view('dojos');        
    }
}
