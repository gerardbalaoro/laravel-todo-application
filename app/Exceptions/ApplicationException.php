<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApplicationException extends Exception
{
    public int $status = 422;

    public function render(Request $request): Response|false
    {
        if ($request->wantsJson()) {
            return response()->json([
                'error' => [
                    'code' => $this->code,
                    'title',
                ],
            ], $this->status ?: 422);
        }

        return false;
    }
}
