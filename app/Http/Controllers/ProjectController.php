<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('company_id', auth()->user()->company->id)->paginate(5);

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        abort_if(!auth()->user()->isOwner(), 403);

        return view('projects.create');
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->isOwner(), 403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date'],
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'company_id' => auth()->user()->company->id,
        ]);

        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        abort_if(auth()->user()->company->id !== $project->company_id, 404);

        $tasks = Task::where('project_id', $project->id)->latest()->paginate(6);

        return view('projects.show', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }

    public function edit(Project $project)
    {
        abort_if(auth()->user()->company->id !== $project->company_id, 404);
        
        abort_if(!auth()->user()->isOwner(), 403);

        return view('projects.edit', [
            'project' => $project,
        ]);    
    }

    public function update(Request $request, Project $project)
    {
        abort_if(auth()->user()->company->id !== $project->company_id, 404);
        
        abort_if(!auth()->user()->isOwner(), 403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date'],
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()->route('projects.index');
    }
    
    public function destroy(Project $project)
    {
        abort_if(auth()->user()->company->id !== $project->company_id, 404);
        
        abort_if(!auth()->user()->isOwner(), 403);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
