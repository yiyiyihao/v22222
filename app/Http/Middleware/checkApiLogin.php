<?php

namespace App\Http\Middleware;

use Closure;

class checkApiLogin
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
        //判断有没有传user_id
        $userId = $request->input('user_id') ?? '';
        if(!$userId || $userId == 'undefined'){
            return response()->json(['code'=>10001,'msg'=>'未登入！']);
        }

        return $next($request);
    }
}
