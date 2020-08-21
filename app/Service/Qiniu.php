<?php
/**
 *
 * Created by huangyihao.
 * User: Administrator
 * Date: 2020/7/23 0023
 * Time: 9:27
 */

namespace App\Service;


class Qiniu
{
    var $config;
    public function __construct()
    {

        $this->config = [
            'accessKey' => 'ViZmjaqh9B_Q27LK1YaML1_ENwjLYAO1RfQVuF5l',  //accessKey
            'secretKey' => '6GV7xKIYheriN9OmOuETcylrHxq0Pp1rwLXF_yte',  //secretKey
            'bucket'    => 'bestchang',                                 //上传的空间
            'domain'    => 'face.bi.worthcloud.net',                    //空间绑定的域名
        ];
    }


    public function qiniu($data)
    {
        // 七牛配置
        $accessKey = $this->config['accessKey'];  //accessKey
        $secretKey = $this->config['secretKey'];  //secretKey
        $bucketName    = $this->config['bucket'];                                 //上传的空间
        $domain    = $this->config['domain'];                    //空间绑定的域名

        $upManager = new \Qiniu\Storage\UploadManager();
        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucketName);

        $qiniuName = date('Ymd').'/nkd_'.date('YmdHis').mt_rand(0,9999) .'.jpeg';
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/',$data, $res)) {
            $data = base64_decode(str_replace($res[1],'', $data));
        }
        list($ret,$err) = $upManager->put($token, $qiniuName, $data);

        if($err !== null){
            return ['code'=> 1,'msg'=>$err];
        }else{
            $url = 'http://'.$domain.'/'.$qiniuName;
            return ['code'=> 0,'msg'=>'upload success','url' => $url];
        }

    }
}