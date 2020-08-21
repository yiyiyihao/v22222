<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Manager;
use Auth;
use DB;
use Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $data = Manager::with(['role'])->get();
        return view('admin/manager/index', compact('data'));
    }

    public function setPassword(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('admin/manager/setPassword');
        }


        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $id = Auth::guard('admin')->user()->id;
        $oldPassword = $request->input('password');
        $newPassword = $request->input('new_password');


        $res = DB::table('manager')->where('id', $id)->select('password')->first();
        if (!Hash::check($oldPassword, $res->password)) {
            $data = ['code' => 1, 'msg' => '密码错误'];
            return response()->json($data);
        }
        $update = array(
            'password' => bcrypt($newPassword),
        );
        $result = DB::table('manager')->where('id', $id)->update($update);
        if ($result) {
            Auth::guard('admin')->logout();
            $data = ['code' => 0, 'msg' => '修改成功，请重新登入'];
            return response()->json($data);
        } else {
            $data = ['code' => 1, 'msg' => '修改失败'];
            return response()->json($data);
        }

    }

    public function operationLog()
    {
        $data = DB::table('operation_log')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin/manager/operationLog', compact('data'));
    }

    //添加管理员
    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            $roleList = DB::table('admin_role')->get();
            return view('admin/manager/add', compact('roleList'));
        }

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|confirmed',
            'mobile' => 'required'
        ]);

        $params = $request->input();
        $username = $params['username'];

        $exist = Manager::where('username', $username)->first();
        if ($exist) {
            return response()->json(['code' => 1, 'msg' => '账户名已经存在！']);
        }

        $data['username'] = $username;
        $data['mobile'] = $params['mobile'];
        $data['email'] = $params['email'];
        $data['password'] = bcrypt($params['password']);
        $data['created_at'] = time();
        $data['status'] = 1;
        $roleIds = $params['role_id'] ?? [];
        //处理用户权限
        if (!in_array('1', $roleIds)) {
            $authAcData = DB::table('admin_role')->whereIn('id', $roleIds)->get();
            if (!empty($authAcData)) {
                $authAc = '';
                foreach ($authAcData as $k) {
                    $authAc .= $k->auth_ac . ',';
                }
                $data['auth_ac'] = rtrim($authAc, ',');
            }
        }

        $result = Manager::insertGetId($data);

        if (!$result) {
            return response()->json(['code' => 1, 'msg' => '添加失败！']);
        }


        $data = [];
        //写入用户角色表中间表
        if (!empty($roleIds)) {
            foreach ($roleIds as $k => $v) {
                $data[] = ['manager_id' => $result, 'role_id' => $v];
            }
        }
        DB::table('admin_manager_role')->insert($data);

        return response()->json(['code' => 0, 'msg' => 'success!']);
    }

    //编辑管理员
    public function edit(Request $request)
    {
        $params = $request->input();
        $managerId = $params['id'] ?? 0;

        if ($request->method() == 'GET') {
            $managerInfo = Manager::with(['role'])->where('id', $managerId)->first();

            $roleList = DB::table('admin_role')->get();
            return view('admin/manager/edit', compact('roleList', 'managerInfo'));
        }

        $password = $params['password'] ?? '';
        if (!$password) {
            $this->validate($request, [
                'username' => 'required',
                'mobile' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required|confirmed',
                'mobile' => 'required'
            ]);
            $data['password'] = bcrypt($password);
        }


        $username = $params['username'];
        $exist = Manager::where('username', $username)->where('id', '!=', $managerId)->first();
        if ($exist) {
            return response()->json(['code' => 1, 'msg' => '账户名已经存在！']);
        }

        $data['username'] = $username;
        $data['mobile'] = $params['mobile'];
        $data['email'] = $params['email'];
        $data['updated_at'] = time();
        $roleIds = $params['role_id'] ?? [];
        //处理用户权限
        if (!in_array('1', $roleIds)) {
            $authAcData = DB::table('admin_role')->whereIn('id', $roleIds)->get();
            if (!empty($authAcData)) {
                $authAc = '';
                foreach ($authAcData as $k) {
                    $authAc .= $k->auth_ac . ',';
                }
                $data['auth_ac'] = rtrim($authAc, ',');
            }
        }

        $result = Manager::where('id', $managerId)->update($data);

        if (!$result) {
            return response()->json(['code' => 1, 'msg' => '修改失败！']);
        }

        $data = [];
        if (!empty($roleIds)) {
            foreach ($roleIds as $k => $v) {
                $data[] = ['manager_id' => $managerId, 'role_id' => $v];
            }
        }
        DB::table('admin_manager_role')->where('manager_id', $managerId)->delete();
        DB::table('admin_manager_role')->insert($data);

        return response()->json(['code' => 0, 'msg' => 'success!']);

    }

}
