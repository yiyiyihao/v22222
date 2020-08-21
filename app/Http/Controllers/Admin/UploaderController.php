<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class UploaderController extends Controller
{
    //
    public function webuploader(Request $request)
    {
    	// 上传操作
    	if($request->file('file')->isValid() && $request->hasFile('file')){
    		//对文件重命名
    		$new = date('YmdHis') . rand(1000,9999) . '.' . $request->file('file') ->getClientOriginalExtension();
    		//保存文件
            //方法一
            // $res = $request->file('file')->storeAs('images',$new);
            //方法二
            $res = Storage::disk('public')->put($new,file_get_contents($request->file('file')->path()));

            if($res){
                $response = [
                    'code'=>0,
                    'msg'=> 'success',
                    'url'=> '/storage/' . $new,
                ];
            }else{
                $response = [
                    'code' => '1',
                    'msg' => 'fail',
                ];
            }
            return response()->json($response);

    	}
    }

    public function qiniu(Request $request)
    {
        // 七牛配置
        $accessKey = 'ViZmjaqh9B_Q27LK1YaML1_ENwjLYAO1RfQVuF5l';  //accessKey
        $secretKey = '6GV7xKIYheriN9OmOuETcylrHxq0Pp1rwLXF_yte';  //secretKey
        $bucketName    = 'bestchang';                                 //上传的空间
        $domain    = 'face.bi.worthcloud.net';                    //空间绑定的域名

        $file = $request->file('file');
        if (!$file) {
            return ['code'=>1,'msg'=>'file是空的'];
        }

        $upManager = new \Qiniu\Storage\UploadManager();
        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucketName);
        // 上传到七牛后保存的文件名
        $filename = date('Ymd').'/nkd_'.substr(md5($file),0,5).date('YmdHis').mt_rand(0,9999) .'.'. $file ->getClientOriginalExtension();
        // 初始化UploadManager类
        list($ret,$err) = $upManager->putFile($token, $filename, $file->getPathname());

        if($err !== null){
            return ['code'=> 1,'msg'=>$err];
        }else{
            $url = 'http://'.$domain.'/'.$filename;
            return ['code'=> 0,'msg'=>'upload success','url' => $url];
        }

    }
}
