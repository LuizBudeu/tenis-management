<?php

namespace App\Exceptions;

use Exception;

class TennisCourtNotFoundException extends Exception
{
    protected int $courtNumber;

    public function __construct($courtNumber)
    {
        $this->courtNumber = $courtNumber;
        parent::__construct("Tennis court $courtNumber not found");
    }

    public function render($request)
    {
        return response()->json([
            'message' => "Tennis court {$this->courtNumber} not found",
        ], 404);
    }
}
