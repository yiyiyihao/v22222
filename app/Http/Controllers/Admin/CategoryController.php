<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Category;
use App\Admin\Goods;

class CategoryController extends Controller
{
    //分类列表
    public function index()
    {
        $data = Category::where('is_del', 0)->orderBy('sort', 'asc')->get();
        return view('admin/category/index', compact('data'));
    }

    //添加分类
    public function add(Request $request)
    {
        $params = $request->input();
        if ($request->method() == 'GET') {
            return view('admin/category/add');
        }

        $data = [
            'cate_name' => $params['cate_name'],
            'sort' => $params['sort'],
            'status' => $params['status'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $res = Category::insert($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '添加失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '添加成功！']);
    }

    //编辑分类
    public function edit(Request $request)
    {
        $params = $request->input();
        $id = $params['id'] ?? 0;
        if (!$id) {
            return response()->json(['code' => 1, 'msg' => '非法id！']);
        }

        if ($request->method() == 'GET') {
            $data = Category::where('id', $id)->first();
            return view('admin/category/edit', compact('data'));
        }

        $data = [
            'cate_name' => $params['cate_name'],
            'sort' => $params['sort'],
            'status' => $params['status'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $res = Category::where('id', $id)->update($data);
        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '修改失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '修改成功！']);
    }

    //删除分类
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

        $res = Category::where('id', $id)->update(['is_del' => 1]);

        if (!$res) {
            return response()->json(['code' => 1, 'msg' => '删除失败！']);
        }

        return response()->json(['code' => 0, 'msg' => '删除成功！']);

    }
}
