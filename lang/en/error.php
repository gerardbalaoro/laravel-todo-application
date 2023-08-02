<?php

use App\Enums\ApplicationError;

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

    ApplicationError::VALIDATION_FAILED() => 'The data you submitted is invalid. Please check your input and try again.',

    ApplicationError::TODO_MOVE_NEXT_FAILED() => 'Unable to save todo in this position.',
];
