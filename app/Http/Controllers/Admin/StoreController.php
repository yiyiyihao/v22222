<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Store;

class StoreController extends Controller
{
    //门店列表
    public function index()
    {
        $data = Store::where('is_del', 0)->get();
        return view('admin/store/index', compact('data'));
    }

    //添加门店
    public function add(Request $request)
    {
        $params = $request->input();
        if ($request->method() == 'GET') {

            return view('admin/store/add');
        }

        $data = [
            'store_no' => date('YmdHis') . rand(1000, 9999),
            'store_type' => 2,
            'store_name' => $params['store_name'],
            'logo' => $params['logo'] ?? '',
            'address' => $params['address'],
            'location' => '',
            'idcard_back_img' => $params['idcard_back_img'] ?? '',
            'idcard_font_img' => $params['idcard_font_img'] ?? '',
            'license_img' => $params['license_img'] ?? '',
            'signing_contract_img' => $params['signing_contract_img'] ?? '',
            'security_money' => $params['security_money'],
            'group_photo' => '',
            'wxacode' => '',
            'admin_remark' => '',
            'enter_type' => 0,
            'check_status' => 1,
            'status' => $params['status'],
            'is_del' => 0,
            'created_at' => time(),
            'updated_at' => time(),
        ];

        $res = Store::insert($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '添加失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '添加成功！']);
    }

    //编辑门店
    public function edit(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? 0;
        if (!$id) {
            return response()->json(['code' => 1, 'msg' => '非法id！']);
        }

        if ($request->method() == 'GET') {
            $data = Store::where('id', $id)->first();
            return view('admin/store/edit', compact('data'));
        }

        $data = [
            'store_name' => $params['store_name'],
            'logo' => $params['logo'],
            'address' => $params['address'],
            'idcard_back_img' => $params['idcard_back_img'] ?? '',
            'idcard_font_img' => $params['idcard_font_img'] ?? '',
            'license_img' => $params['license_img'] ?? '',
            'signing_contract_img' => $params['signing_contract_img'] ?? '',
            'security_money' => $params['security_money'] ?? '',
            'status' => $params['status'],
            'updated_at' => time(),
        ];

        $res = Store::where('id', $id)->update($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '修改失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '修改成功！']);
    }

    //删除门店
    public function del(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? 0;
        if (!$id) {
            return response()->json(['code' => 1, 'msg' => '非法id！']);
        }

        $res = Store::where('id', $id)->update(['is_del' => 1]);

        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '删除失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '删除成功！']);

    }

}
