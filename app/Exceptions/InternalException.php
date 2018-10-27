<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;

class InternalException extends Exception
{
    //
    protected $msgToUser;

    public function __construct(string $message = "", $msgToUser, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->msgToUser = $msgToUser;
    }

    public function rander(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['msg' => $this->msgToUser, 'code' => $this->code]);
        }

        return view('pages.error', ['msg' => $this->msgToUser]);
    }
}
