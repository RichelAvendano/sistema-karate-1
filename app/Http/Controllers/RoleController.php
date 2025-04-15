<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if( Auth::check() && Auth::user()->role === 'admin'){
            return view('role', [
                'user' => $request->user(),
            ]);
        }else{
            return Redirect::route('dashboard')->with('error', 'You do not have access to this page.');
        }        
    }
}
