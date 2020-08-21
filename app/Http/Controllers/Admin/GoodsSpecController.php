<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\GoodsSpec;

class GoodsSpecController extends Controller
{
    //规格列表
    public function index()
    {
        $data = GoodsSpec::where('is_del', 0)->orderBy('sort','asc')->get();
        return view('admin/goodsSpec/index', compact('data'));
    }

    //添加规格
    public function add(Request $request)
    {
        $params = $request->input();
        if ($request->method() == 'GET') {
            return view('admin/goodsSpec/add');
        }

        $data = [
            'spec_name' => $params['cate_name'],
            'sort' => $params['sort'],
            'status' => $params['status'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $res = GoodsSpec::insert($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '添加失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '添加成功！']);
    }

    //编辑规格
    public function edit(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? 0;
        if (!$id) {
            return response()->json(['code' => 1, 'msg' => '非法id！']);
        }

        if ($request->method() == 'GET') {
            $data = GoodsSpec::where('id', $id)->first();
            return view('admin/goodsSpec/edit', compact('data'));
        }

        $data = [
            'cate_name' => $params['cate_name'],
            'sort' => $params['sort'],
            'status' => $params['status'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $res = GoodsSpec::where('id', $id)->update($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '修改失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '修改成功！']);
    }

    //删除规格
    public function del(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? 0;
        if (!$id) {
            return response()->json(['code' => 1, 'msg' => '非法id！']);
        }
        $existGoods = Goods::where('cate_id', $id)->where('is_del', 0)->get();
        if ($existGoods->count() > 0) {
            return response()->json(['code' => 1, 'msg' => '分类下有商品，不可删除！']);
        }

        $res = GoodsSpec::where('id', $id)->update(['is_del' => 1]);

        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '删除失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '删除成功！']);

    }
}
