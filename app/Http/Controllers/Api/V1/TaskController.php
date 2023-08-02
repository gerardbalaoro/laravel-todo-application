<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateTask;
use App\Actions\UpdateTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateTaskRequest;
use App\Http\Requests\V1\UpdateTaskRequest;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * List all tasks.
     */
    public function index()
    {
        $tasks = Task::orderBy('position')->get();

        return TaskResource::collection($tasks);
    }

    /**
     * Create new task.
     */
    public function store(CreateTaskRequest $request)
    {
        $task = (new CreateTask(
            $request->validated('name'),
            $request->validated('position'),
        ))->run();

        return new TaskResource($task);
    }

    /**
     * Show specified task.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified task.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task = (new UpdateTask(
            task: $task,
            name: $request->validated('name'),
            position: $request->validated('position'),
            done: (bool) $request->validated('is_done'),
        ))->run();

        return new TaskResource($task);
    }

    /**
     * Delete the specified task.
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }
}
