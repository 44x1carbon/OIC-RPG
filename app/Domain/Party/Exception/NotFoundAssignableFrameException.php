<?php

namespace App\Domain\Party\Exception;

use Exception;

class NotFoundAssignableFrameException extends Exception
{
    protected $message = "割り当て可能な募集枠がありません。";
}