<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateTodo;
use App\Actions\UpdateTodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateTodoRequest;
use App\Http\Requests\V1\UpdateTodoRequest;
use App\Http\Resources\V1\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * List all todos.
     */
    public function index()
    {
        $todos = Todo::orderBy('position')->get();

        return TodoResource::collection($todos);
    }

    /**
     * Create new todo.
     */
    public function store(CreateTodoRequest $request)
    {
        $todo = (new CreateTodo(
            $request->validated('name'),
            $request->validated('position'),
        ))->run();

        return new TodoResource($todo);
    }

    /**
     * Show specified todo.
     */
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Update the specified todo.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo = (new UpdateTodo(
            todo: $todo,
            name: $request->validated('name'),
            position: $request->validated('position'),
            done: (bool) $request->validated('is_done'),
        ))->run();

        return new TodoResource($todo);
    }

    /**
     * Delete the specified todo.
     */
    public function destroy(string $id)
    {
        //
    }
}
