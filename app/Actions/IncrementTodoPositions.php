<?php

namespace App\Actions;

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
        Todo::where('position', '>=', $this->position)
            ->increment('position', $this->increment);
    }
}
