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
        protected ?string $name = null,
        protected ?int $position = null,
        protected ?bool $done = null,
    ) {
    }

    public function run(): Task
    {
        if ($this->name !== null) {
            $this->task->name = $this->name;
        }
        if ($this->done !== null) {
            $this->task->is_done = $this->done;
        }

        if ($this->position) {
            $this->task->place($this->position);
        }

        $this->task->save();

        return $this->task;
    }
}
