<?php

namespace App\Actions;

use App\Models\Todo;

/**
 * Create new todo from fresh model instance.
 */
class UpdateTodo
{
    public function __construct(
        protected Todo $todo,
        protected string $name,
        protected ?int $position = null,
        protected bool $done = false,
    ) {
    }

    public function run(): Todo
    {
        $this->todo->name = $this->name;
        $this->todo->is_done = $this->done;

        if ($this->position) {
            $this->todo->place($this->position);
        }

        $this->todo->save();

        return $this->todo;
    }
}
