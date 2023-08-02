<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $order
 * @property bool $is_done
 */
class Todo extends Model
{
    use HasFactory;
}
