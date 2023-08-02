<?php

namespace App\Actions;

use App\Models\Todo;

/**
 * Create new todo from fresh model instance.
 */
class CreateTodo
{
    public function __construct(
        protected string $name,
        protected ?int $position = null,
    ) {
    }

    public function run(): Todo
    {
        $todo = new Todo(['name' => $this->name]);
        $todo->place($this->position ?: -1);

        return $todo;
    }
}
