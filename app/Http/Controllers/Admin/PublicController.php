<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class PublicController extends Controller
{
    //
    public function login()
    {
        return view('admin.public.login');
    }

    //登入提交
    public function check(Request $request)
    {
        $this->validate($request, [
//            'geetest_challenge' => 'geetest',
                'username' => 'required|min:2|max:20',
                'password' => 'required|min:1',
//            'captcha' => 'captcha',
            ]
//        , [
//            'geetest' => config('geetest.server_fail_alert')
//        ]
        );

        $remember = !!($request->get('online') ?? false);

        $params = $request->only('username', 'password');
        $params['status'] = 1;

        if (Auth::guard('admin')->attempt($params, $remember)) {
            //成功
            return redirect('/admin/index/index');
        } else {
            //失败
            return redirect('/admin/public/login')->withErrors(['loginErr' => '用户名或密码错误']);
        }

    }


    //退出
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/public/login');
    }

}
