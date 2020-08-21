<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Role;
use App\Admin\Auth;
use App\Admin\Store;
use DB;

class RoleController extends Controller
{
    //
    public function index()
    {
        $data = Role::get();
        return view('admin/role/index', compact('data'));
    }

    public function assign(Request $request)
    {
        if ($request->isMethod('POST')) {
            $role = new Role();
            $params = $request->only(['id', 'auth_id']);
            $res = $role->assignAuth($params);
            if ($res) {
                $response = ['code' => 0, 'msg' => 'success'];
            } else {
                $response = ['code' => 1, 'msg' => 'fail'];
            }
            return response()->json($response);

        } else {
            $id = $request->get('id');
            $role = Role::find($id);
            //权限列表
            $one = Auth::where('pid', 0)->get();
            $two = Auth::where('pid', '<>', 0)->get();
            return view('admin/role/assign', compact('role', 'one', 'two'));
        }

    }

    public function assignApp(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->only(['id', 'app_auth_ids']);
            $data['app_auth_ids'] = implode($params['app_auth_ids'],',');

            $res = Role::where('id',$params['id'])->update($data);

            if ($res) {
                $response = ['code' => 0, 'msg' => 'success'];
            } else {
                $response = ['code' => 1, 'msg' => 'fail'];
            }
            return response()->json($response);

        } else {
            $id = $request->get('id');
            $role = Role::find($id);
            //权限列表
            $one = DB::table('app_auth')->where('parent_id', 0)->get();
            $two = DB::table('app_auth')->where('parent_id', '<>', 0)->get();
            return view('admin/role/assignApp', compact('role', 'one', 'two'));
        }

    }

    //添加角色
    public function add(Request $request)
    {
        $params = $request->input();

        if ($request->method() == 'GET') {
            return view('admin/role/add');
        }

        $data = [
            'role_name' => $params['role_name'],
        ];

        $res = Role::insert($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '添加失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '添加成功！']);

    }


    //编辑角色
    public function edit(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? '';

        if ($request->method() == 'GET') {
            $data = Role::where('id', $id)->first();
            return view('admin/role/edit', compact('data'));
        }

        $data = [
            'role_name' => $params['role_name'],
        ];

        $res = Role::where('id',$id)->update($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '修改失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '修改成功！']);

    }
}
