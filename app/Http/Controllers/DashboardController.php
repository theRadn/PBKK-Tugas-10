<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $projects = Project::with('user')
             ->when($request->search, function ($query, $search) {
                 // Group the OR conditions so they stay isolated from any
                 // future WHERE clauses (e.g. per-user scoping).
                 $query->where(function ($q) use ($search) {
                     $q->where('judul', 'like', "%{$search}%")
                       ->orWhere('tema_agent', 'like', "%{$search}%")
                       ->orWhereHas('user', function ($sub) use ($search) {
                           $sub->where('name', 'like', "%{$search}%");
                       });
                 });
             })
             ->latest()
             ->paginate(6)
             ->withQueryString();

        return view('dashboard', compact('user', 'projects'));
    }

    /**
     * Update a project. Admin-only (guarded by the "delete-data" permission).
     */
    public function update(Request $request, Project $project)
    {
        if (! $request->user()->can('delete-data')) {
            abort(403, 'Hanya Admin yang boleh mengedit project.');
        }

        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'tema_agent'     => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'api_key_secure' => 'nullable|string|max:255',
        ]);

        // Preserve existing API key if the field is left blank
        if (empty($validated['api_key_secure'])) {
            unset($validated['api_key_secure']);
        }

        $project->update($validated);

        return back()->with('success_data', 'Project berhasil diperbarui.');
    }

    /**
     * Delete a project. Only users with the "delete-data" permission
     * (Admin role) are allowed to do this.
     */
    public function destroy(Request $request, Project $project)
    {
        if (! $request->user()->can('delete-data')) {
            abort(403, 'Hanya Admin yang boleh menghapus project.');
        }

        $project->delete();

        return back()->with('success_data', 'Project berhasil dihapus.');
    }
}
