<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

// php artisan make:exception InvalidRequestException 创建错误类
class InvalidRequestException extends Exception
{
    //
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function rander(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['msg' => $this->message, 'code' => $this->code]);
        }

        return view('pages.error', ['msg' => $this->message]);
    }
}
