<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskRequest $request): JsonResponse
    {
        $search = $request->input('search', '');
        $sort = $request->input('sort', 'created_at');

        $query = Task::query();

        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        if (in_array($sort, ['due_date', 'created_at'])) {
            $query->orderBy($sort);
        } else {
            $query->orderBy('created_at');
        }

        $tasks = $query->paginate(3);

        Log::info('Tasks retrieved', ['tasks' => $tasks]);

        return response()->json(['data' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = Task::create($data);

        return response()->json([
            'id' => $task->id,
            'message' => 'Task created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json(['data' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task): JsonResponse
    {
        $data = $request->validated();
        $task->update($data);

        return response()->json([
            'message' => 'Task updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
