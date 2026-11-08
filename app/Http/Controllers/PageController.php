<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $welcomeUser = $request->query('user');

        return view('home', compact('welcomeUser'));
    }

    public function agent()
    {
        return view('fp_idea');
    }

    public function mahasiswaDetail()
    {
        $nrp = '5025241104';
        return view('mahasiswa', compact('nrp'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'required|string|max:1000',
            'tema_agent' => 'required|string|max:255',
            'api_key_secure' => 'nullable|string',
        ]);

        $project = Auth::user()->projects()->create([
            'judul'      => $validated['judul'],
            'deskripsi'  => $validated['deskripsi'],
            'tema_agent' => $validated['tema_agent'],
            'api_key_secure' => $request['api_key_secure'] ?? null,
        ]);

        return redirect()->back()->with('success_data',
            "Project {$project->judul} saved successfully!"
        );
    }
}
