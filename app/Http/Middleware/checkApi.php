<?php

namespace App\Http\Middleware;

use Closure;

class checkApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //验证签名
        $this->signKey = $request->input('signkey') ?? '';
        //客户端签名密钥get_nonce_str(12)
        $this->signKeyList = array(
            'Applets'   => '8c45pve673q1',
        );
        return $this->verifySignParam($request->input(),$request, $next);


    }

    protected function verifySignParam($data = [],$request,$next)
    {
        // 验证必填参数
        $timestamp = $request->input('timestamp') ?? '';
        if(!$timestamp) {
            return response()->json(['code'=>1,'msg'=>'请求时间戳(timestamp)参数缺失']);
        }
        $len = strlen($timestamp);
        if($len != 10 && $len != 13) {//时间戳长度格式不对
            return response()->json(['code'=>1,'msg'=>'时间戳格式错误']);
        }
        if (strlen($timestamp) == 13) {
            $request->input()['timestamp'] = substr($timestamp, 0, 10);
        }
        if($timestamp + 180 < time()) {//时间戳已过期(60秒内过期)
            return response()->json(['code'=>1,'msg'=>'请求已超时']);
        }
        if(!$this->signKey) {
            return response()->json(['code'=>1,'msg'=>'签名密钥(signkey)参数缺失']);
        }
        if(!in_array($this->signKey, $this->signKeyList)) {
            return response()->json(['code'=>1,'msg'=>'签名密钥错误']);
        }
        if (isset($data['file'])) {
            unset($data['file']);
        }
        $postSign = $request->input('sign') ?? '';
        if (!$postSign) {
            return response()->json(['code'=>1,'msg'=>'签名(sign)参数缺失']);
        }
        $sign = $this->getSign($data, $this->signKey);
        if ($postSign != $sign) {
            return response()->json(['code'=>1,'msg'=>'签名错误']);
        }

        return $next($request);
    }

    /**
     * 参数签名生成算法
     * @param array $params  key-value形式的参数数组
     * @param string $signkey 参数签名密钥
     * @return string 最终的数据签名
     */
    protected function getSign($params, $signkey)
    {
        //除去待签名参数数组中的空值和签名参数(去掉空值与签名参数后的新签名参数组)
        $para = array();
        foreach($params as $key => $value){
            if($key == 'sign' || $key == 'signkey' || $value === "")continue;
            else $para[$key] = $params[$key];
        }
        //对待签名参数数组排序
        ksort($para);
        reset($para);

        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr  = "";
        foreach($para as $k => $v){
            if (is_array($v)) {
                $prestr.= $k."=".implode(',', $v)."&";
            }else{
                $prestr.= $k."=".$v."&";
            }
        }
        //去掉最后一个&字符
        $prestr = trim($prestr,"&");

        //字符串末端补充signkey签名密钥
        $prestr = $prestr . $signkey;
        //生成MD5为最终的数据签名
        $mySgin = md5($prestr);
        return $mySgin;
    }



}
