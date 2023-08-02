<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationException extends Exception implements Arrayable, Responsable
{
    public ?int $status;
    public array $meta = [];

    public function __construct(string $message, string $code)
    {
        parent::__construct($message);
        $this->code = $code;
    }

    public function toArray()
    {
        return array_filter([
            'code' => $this->code,
            'message' => $this->message,
            'meta' => $this->meta,
        ]);
    }

    public function toResponse($request)
    {
        return response()->json(
            ['error' => $this->toArray()],
            $this->status ?: 422
        );
    }

    public function render(Request $request): Response|false
    {
        if ($request->wantsJson()) {
            return $this->toResponse($request);
        }

        return false;
    }
}
