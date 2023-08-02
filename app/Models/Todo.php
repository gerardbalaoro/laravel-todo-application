<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $name
 * @property int $position
 * @property bool $is_done
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'is_done',
    ];

    /**
     * Place the todo in the specified position.
     * Automatically rearrange the list.
     */
    public function place(int $position = -1): self
    {
        DB::transaction(function () use ($position) {
            $current = $this->position;
            $position = $position <= 0
                ? static::lastPosition()
                : min(max(1, $position), static::lastPosition());

            if ($this->exists && $current && $current != $position) {
                if ($current < $position) {
                    static::whereBetween('position', [$current + 1, $position])
                        ->decrement('position');
                } else {
                    static::whereBetween('position', [$position, $current - 1])
                        ->increment('position');
                }
            } else {
                static::where('position', '>=', $position)
                    ->increment('position');
            }

            $this->position = $position;
            $this->save();
        });

        return $this;
    }

    /**
     * Return the last position in the list.
     */
    public static function lastPosition(): int
    {
        return static::max('position') + 1;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (self $todo) {
            static::where('position', '>', $todo->position)
                ->decrement('position');
        });
    }
}
