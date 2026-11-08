<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $projects = $user->projects()->latest()->get();

        return view('dashboard', compact('user', 'projects'));
    }
}
