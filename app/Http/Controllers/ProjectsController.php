<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::paginate(10);
        return view('General.projects', compact('projects'));
    }

    public function create()
    {
        return view('General.projects-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_code' => 'required|unique:projects,project_code',
            'project_name' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Projects::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project successfully added.');
    }

    public function edit(Projects $project)
    {
        return view('General.projects-edit', compact('project'));
    }

    public function update(Request $request, Projects $project)
    {
        $validated = $request->validate([
            'project_code' => 'required|unique:projects,project_code,' . $project->id,
            'project_name' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project successfully updated.');
    }

    public function destroy(Projects $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project successfully deleted.');
    }
}
