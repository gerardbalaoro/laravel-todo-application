<?php

namespace App\Enums;

use App\Exceptions\ApplicationException;
use ArchTech\Enums\InvokableCases;

enum ApplicationError
{
    use InvokableCases;

    case VALIDATION_FAILED;

    case TODO_MOVE_NEXT_FAILED;

    public function message(): string
    {
        return __('error.'.$this->name);
    }

    public function status(): int
    {
        return 422;
    }

    public function exception(array $meta = []): ApplicationException
    {
        $exception = new ApplicationException($this->message(), $this->name);
        $exception->status = $this->status();
        $exception->meta = $meta;

        return $exception;
    }
}
