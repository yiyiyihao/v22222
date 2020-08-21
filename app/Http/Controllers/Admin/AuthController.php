<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Auth;
use DB;

class AuthController extends Controller
{
    public function index()
    {
        // $data = Auth::get();
        $data = DB::table('admin_auth as t1')
            ->select('t1.*', 't2.auth_name as parent_name')
            ->leftJoin('admin_auth as t2', 't2.id', '=', 't1.pid')
            ->get();
        return view('admin/auth/index', compact('data'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'auth_name' => 'required',
                'is_nav' => 'required',
                'pid' => 'required',
            ]);
            $params = $request->except('_token');
            $res = Auth::insert($params);
            if ($res) {
                return response()->json(['code' => 0, 'msg' => 'success']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'fail']);
            }
        } else {
            $parent = Auth::where('pid', '0')->get();
            return view('admin/auth/add', compact('parent'));
        }
    }

    //app权限列表
    public function app()
    {
        $data = DB::table('app_auth as t1')
            ->select('t1.*', 't2.name as parent_name')
            ->leftJoin('app_auth as t2', 't2.id', '=', 't1.parent_id')
            ->get();
        return view('admin/auth/app', compact('data'));
    }

    //添加app权限
    public function addAppAuth(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required',
                'is_nav' => 'required',
                'parent_id' => 'required',
            ]);
            $params = $request->input();
            $data = [
                'parent_id' => $params['parent_id'] ?? 0,
                'name' => $params['name'] ?? '',
                'is_nav' => $params['is_nav'] ?? 0,
                'img' => $params['img'] ?? '',
                'status' => 1,
                'created_at' => time()
            ];
            $res = DB::table('app_auth')->insert($data);
            if ($res) {
                return response()->json(['code' => 0, 'msg' => 'success']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'fail']);
            }
        } else {
            $parent = DB::table('app_auth')->where('parent_id', '0')->get();
            return view('admin/auth/addAppAuth', compact('parent'));
        }
    }

}
