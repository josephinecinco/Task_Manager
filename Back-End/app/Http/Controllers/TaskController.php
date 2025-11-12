<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /tasks - list all tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // GET /tasks/{id} - show single task
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    // POST /tasks - create new task
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    // PUT/PATCH /tasks/{id} - update task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in-progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    // DELETE /tasks/{id} - delete task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
