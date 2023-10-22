<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        $users = User::where('company_id', auth()->user()->company->id)->pluck('name', 'id');

        return view('tasks.create', [
            'project' => $project,
            'users' => $users
        ]);
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'assigned_to' => ['required'],
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'project_id' => $project->id,
            'company_id' => auth()->user()->company->id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('projects.show', $project);
    }
    
    public function show(Task $task)
    {
        abort_if($task->company_id !== auth()->user()->company->id, 404);
        
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function update(Task $task)
    {
        $user = auth()->user();

        if($user->id === $task->assigned_to){
            $task->update(['status' => Task::INPROGRESS]);
        } else if($user->id === $task->created_by) {
            $task->update(['status' => Task::COMPLETED]);
        }

        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        abort_if(auth()->user()->company->id !== $task->company_id, 404);

        abort_if(!auth()->user()->isOwner(), 403);

        $project = $task->project;

        $task->delete();

        return redirect()->route('projects.show', $project);
    }
}
