<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()->email_verified) {
            // 是否为AJAX请求，则返回JSON返回
            if ($request->expectsJson()) {
                return response()->json(['msg' => '请验证邮箱'], 400);
            }

            return redirect(route('email_verify_notice'));
        }
        return $next($request);
    }
}
