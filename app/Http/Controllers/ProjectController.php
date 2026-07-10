<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function update(Request $request)
    {
        // Security check
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            // 15,000 characters safely accommodates a structured 2,000 to 2,500 word description
            'description' => 'required|string|max:15000', 
        ]);

        // Find the active configuration or create a baseline template
        $project = Project::firstOrCreate(['id' => 1], [
            'title' => 'Project System Roadmap',
            'description' => 'Awaiting details.'
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return back()->with('success', 'Project specifications successfully broadcast to employee dashboards.');
    }
}