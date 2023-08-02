<?php

namespace App\Actions;

use App\Models\Todo;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($todo) {
            $lastPosition = Todo::max('position');

            if (is_numeric($this->position) && $this->position <= $lastPosition) {
                (new IncrementTodoPositions($this->position))->run();
                $todo->position = $this->position;
            } else {
                $todo->position = Todo::max('position') + 1;
            }

            $todo->save();
        });

        return $todo;
    }
}
