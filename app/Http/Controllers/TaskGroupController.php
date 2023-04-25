<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskGroup;

class TaskGroupController extends Controller
{
    public function index()
    {
        $taskGroups = TaskGroup::all();

        return view('taskgroups.index', compact('taskGroups'));
    }

    public function create()
    {
        return view('taskgroups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $taskGroup = TaskGroup::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('taskgroups.show', $taskGroup);
    }

    public function show(TaskGroup $taskgroup)
    {
        $tasks = $taskgroup->tasks()->orderBy('due_date', 'asc')->get();

        return view('taskgroups.show', compact('taskgroup', 'tasks'));
    }

    public function edit(TaskGroup $taskgroup)
    {
        return view('taskgroups.edit', compact('taskgroup'));
    }

    public function update(Request $request, TaskGroup $taskgroup)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $taskgroup->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('taskgroups.show', $taskgroup);
    }

    public function destroy(TaskGroup $taskgroup)
    {
        $taskgroup->delete();

        return redirect()->route('taskgroups.index');
    }
}
