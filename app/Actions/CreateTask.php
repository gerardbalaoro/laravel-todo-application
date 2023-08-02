<?php

namespace App\Actions;

use App\Models\Task;

/**
 * Create new task from fresh model instance.
 */
class CreateTask
{
    public function __construct(
        protected string $name,
        protected ?int $position = null,
    ) {
    }

    public function run(): Task
    {
        $task = new Task(['name' => $this->name]);
        $task->place($this->position ?: -1);

        return $task;
    }
}
