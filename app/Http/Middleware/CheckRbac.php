<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$route = Route::currentRouteAction();
        //$tmp = explode('\\', $route);
        //$superAdmin = Auth::guard('admin')->user()->role;//dd($superAdmin);
        //$adminRoleId = 0;
        //foreach ($superAdmin as $k => $v) {
        //    if ($v->store_id == 0) {
        //        $adminRoleId = $v->id;
        //        $key = $k;
        //    }
        //}
        //if ($adminRoleId == 0) {
        //    return redirect('/admin/public/login')->withErrors(['loginErr'=>'非法用户']);
        //}
        //if ($adminRoleId <> 1) {
        ////        if(!in_array($superAdmin,[1,2])){
        //    $ac = Auth::guard('admin')->user()->role[$key]->auth_ac;
        //    if (stripos($ac, end($tmp)) === false) {
        //        abort(403, 'Unauthorized action.');
        ////                return back()->withErrors(['未授权！']);
        //    }
        //}
        $route = Route::currentRouteAction();
        $tmp = explode('\\', $route);
        $Roles = Auth::guard('admin')->user()->role;//用户第一个角色
        $username = Auth::guard('admin')->user()->username;

        if (empty($Roles)) {
            return redirect('/admin/public/login')->withErrors(['loginErr'=>'用户分配角色！']);
        }

        if ($username <> 'admin' && $Roles[0]->id <> 1) {
//        if(!in_array($superAdmin,[1,2])){
            $ac = Auth::guard('admin')->user()->auth_ac;
            if (stripos($ac, end($tmp)) === false) {
                abort(403, 'Unauthorized action.');
//                return back()->withErrors(['未授权！']);
            }
        }

        return $next($request);
    }
}
