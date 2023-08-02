<?php

use App\Enums\ErrorCase;

return [

    /*
    |--------------------------------------------------------------------------
    | Error Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various error
    | messages that we need to display to the user.
    |
    */

    ErrorCase::VALIDATION_FAILED() => 'The data you submitted is invalid. Please check your input and try again.',

    ErrorCase::TODO_CREATE_ALREADY_EXISTS() => 'The todo you are trying to create already exists.',
    ErrorCase::TODO_MOVE_NEXT_FAILED() => 'Unable to save todo in this position.',
];
