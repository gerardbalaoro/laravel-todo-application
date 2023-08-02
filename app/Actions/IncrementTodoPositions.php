<?php

namespace App\Actions;

use App\Enums\ApplicationError;
use App\Models\Todo;

/**
 * Create new todo from fresh model instance.
 */
class IncrementTodoPositions
{
    public function __construct(
        protected int $position,
        protected int $increment = 1,
    ) {
    }

    public function run()
    {
        try {
            Todo::where('position', '>=', $this->position)
                ->increment('position', $this->increment);
        } catch (\Exception $e) {
            throw ApplicationError::TODO_MOVE_NEXT_FAILED()->exception();
        }
    }
}
