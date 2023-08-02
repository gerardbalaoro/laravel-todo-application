<?php

namespace App\Actions;

use App\Models\Task;

/**
 * Create new todo from fresh model instance.
 */
class UpdateTask
{
    public function __construct(
        protected Task $task,
        protected string $name,
        protected ?int $position = null,
        protected bool $done = false,
    ) {
    }

    public function run(): Task
    {
        $this->task->name = $this->name;
        $this->task->is_done = $this->done;

        if ($this->position) {
            $this->task->place($this->position);
        }

        $this->task->save();

        return $this->task;
    }
}
