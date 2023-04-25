<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskGroup;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasksToday = Task::whereDate('due_date', Carbon::today())->get();
        $tasksTomorrow = Task::whereDate('due_date', Carbon::tomorrow())->get();
        $tasksNextWeek = Task::whereBetween('due_date', [Carbon::tomorrow(), Carbon::now()->addWeek()])->get();
        $tasksNext = Task::where('due_date', '>', Carbon::now()->addWeek())->get();

        return view('tasks.index', compact('tasksToday', 'tasksTomorrow', 'tasksNextWeek', 'tasksNext'));
    }

    public function create()
    {
        $taskGroups = TaskGroup::where('user_id', auth()->id())->get();

        return view('tasks.create', compact('taskGroups'));
    }

    public function store(Request $request)
    {
        $task = new Task();

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->task_group_id = $request->input('task_group_id');
        $task->user_id = auth()->id();

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $taskGroups = TaskGroup::where('user_id', auth()->id())->get();

        return view('tasks.edit', compact('task', 'taskGroups'));
    }

    public function update(Request $request, Task $task)
    {
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->task_group_id = $request->input('task_group_id');

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
