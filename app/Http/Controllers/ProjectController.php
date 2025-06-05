<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;


class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/Index', [
            'projects' => Project::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Project::create($request->only('name'));

        return redirect()->route('projects.index')->with('success', 'Proyecto creado');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', [
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $project->update($request->only('name'));

        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado');
    }
}
