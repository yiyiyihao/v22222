<?php
include_once 'File/X509.php';
include_once 'Math/BigInteger.php';
include_once 'Crypt/RSA.php';
include_once 'Crypt/Hash.php';
class Demo{
    /**
     *创建一个普通用户;
     * 可以进行验证手机号码等后续操作
     * @param $userId
     * @param int $memberType 用户类型 2=企业用户 3=个人用户
     * @param int $source 本次终端访问类型 1=mobile 2=pc
     * @return void
     * @throws Exception
     * @author  trendpower
     */
    public function createMember($userId, $memberType = 3, $source = 1)
    {
        $param["bizUserId"] = (string)$userId;
        $param["memberType"] = $memberType;
        $param["source"] = $source;
        
        $serviceName = $this->apiUrls['registerUserApi']['service'];//MemberService
        $motherName = $this->apiUrls['registerUserApi']['method'];//createMember
        $result = $this->request($serviceName, $motherName, $param);
        
        if ($result && $result['status'] == "OK") {
            $signedValue = json_decode($result['signedValue'], 1);
            $thirdUserId = $signedValue['userId'];
            
            $data['state'] = true;
            $data['msg'] = "新用户注册成功=" . $thirdUserId;
            $data['thirdUserId'] = $thirdUserId;
            $data['signedValue'] = $signedValue;
        } else {
            $data['state'] = false;
            $data['msg'] = empty($result['signedValue']) ? null : $result['signedValue'];
        }
        return $data;
    }
    
    /**
     *请求封装
     * @param $service 服务名称
     * @param $method 方法名称
     * @param $param  其他的参数
     * @return 返回类型
     * @throws Exception
     * @author  trendpower
     */
    public function request($service, $method, $param)
    {
        
        
        $ssoid = $this->merchantCode;  //商户ID
        if (empty($ssoid)) {
            return null;
        }
        $request["service"] = $service;
        $request["method"] = $method;
        $request["param"] = $param;
        $strRequest = json_encode($request);
        $strRequest = str_replace("\r\n", "", $strRequest);
        $req['req'] = $strRequest;
        $req['sysid'] = $ssoid;
        $timestamp = date("Y-m-d H:i:s", time());
        $sign = $this->sign($ssoid, $strRequest, $timestamp);
        $req['timestamp'] = $timestamp;
        $req['sign'] = $sign;
        $req['v'] = $this->version;
        $serverAddress = $this->requestUrl;
        $result = $this->requestYSTAPI($serverAddress, $req);
        return $this->checkResult($result);
    }
    
    /**
     *对数据进行加密
     * @param $ssoid
     * @param $strRequest
     * @param $timestamp
     * @return 返回类型
     * @author  trendpower
     */
    public function sign($ssoid, $strRequest, $timestamp)
    {
        
        
        if (intval($this->version) == 2) {
            $dataStr = $ssoid . $strRequest . $timestamp;
            
            $text = base64_encode(hash('md5', $dataStr, true));
        } else {
            $text = $ssoid . $strRequest . $timestamp;
        }
        
        
        $privateKey = $this->getPrivateKey();
        openssl_sign($text, $sign, $privateKey);
        openssl_free_key($privateKey);
        $sign = base64_encode($sign);
        return $sign;
        
    }
    
    /**
     *获取私匙的绝对路径;
     * @param 参数1
     * @param 参数2
     * @return 返回类型
     * @author  trendpower
     */
    public function getPrivateKey($path,$pwd)
    {
        return $this->loadPrivateKey($path,$pwd);
    }
    
    
    /**
     * 从证书文件中装入私钥 pem格式;
     * @param path 证书路径的绝对路径
     * @param password 证书密码
     * @return 私钥
     * @throws Exception
     */
    public function loadPrivateKey($path, $pwd)
    {
        
        //判断文件的格式
        $str = explode('.', $path);
        $houzuiName = $str[count($str) - 1];
        if ($houzuiName == "pfx") {
            return $this->loadPrivateKeyByPfx($path, $pwd);
        }
        
        if ($houzuiName == "pem") {
            $priKey = file_get_contents($path);
            $res = openssl_get_privatekey($priKey, $pwd);
            if (!$res) {
                exit('您使用的私钥格式错误，请检查私钥配置');
            }
            
            return $res;
        }
        
        
    }
    
    
    
    /**
     * 从证书文件中装入私钥 Pfx 文件格式
     * @param path 证书路径
     * @param password 证书密码
     * @return 私钥
     * @throws Exception
     */
    public function loadPrivateKeyByPfx($path, $pwd)
    {
        if (file_exists($path)) {
            $priKey = file_get_contents($path);
            
            
            if (openssl_pkcs12_read($priKey, $certs, $pwd)) {
                $privateKey = $certs['pkey'];
                return $privateKey;
            }
            die("私钥文件格式错误");
            
        }
        die('私钥文件不存在');
    }
    /**
     *请求云商通URL
     * @param 参数1
     * @param 参数2
     * @return 返回类型
     * @author  trendpower
     */
    public function requestYSTAPI($serverUrl, $args)
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $serverUrl);
        
        $sb = '';
        $reqbody = array();
        foreach ($args as $entry_key => $entry_value) {
            $sb .= $entry_key . '=' . urlencode($entry_value) . '&';
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $sb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-length', count($reqbody)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        
        curl_close($ch);
        return $result;
    }
    
    /**
     *检查返回的结果是否合法;
     * @param $result 需要检测的返回结果
     * @return bool
     * @throws Exception
     * @author  trendpower
     */
    public function checkResult($result)
    {
        
        $arr = json_decode($result, true);
        
        $sign = $arr['sign'];
        $signedValue = $arr['signedValue'];
        
        $success = false;
        if ($sign != null) {
            //云商通API 的版本.
            if ($this->version == 2) {
                
                $success = $this->verify2($this->getPublicKeyPath(), $signedValue, $sign);
            }
            
            if ($this->version == 1) {
                $success = $this->verify($this->getPublicKeyPath(), $signedValue, $sign);
            }
            
        }
        if ($success) {
            return $arr;
        }
        return $success;
    }
    
    
    /**
     *验证的返回结果的合法性 2.0版本
     * @param $publicKeyPath 公匙所在绝对路径
     * @param $signedValue  返回的数据
     * @param $sign     返回的加密数据
     * @return bool
     * @author  trendpower
     */
    public function verify2($publicKeyPath, $signedValue, $sign)
    {
        $certfile = file_get_contents($publicKeyPath);
        if (!$certfile) {
            return null;
        }
        $x509 = new File_X509();//请自行去github下载;
        $cert = $x509->loadX509($certfile);
        $publicKey = $x509->getPublicKey();
        
        $rsa = new Crypt_RSA();
        $rsa->loadKey($publicKey); // public key
        $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
        
        
        $signedValue = base64_encode(hash('md5', $signedValue, true));
        $verifyResult = $rsa->verify($signedValue, base64_decode(trim($sign)));
        
        return $verifyResult;
        
        
    }
    
    
    /**
     *验证返回的数据的合法性
     * @param $publicKeyPath 公匙整数所在的绝对路径
     * @param $text
     * @param $sign
     * @return bool
     * @throws Exception
     * @author  trendpower
     */
    public function verify($publicKeyPath, $text, $sign)
    {
        
        $publicKey = $this->loadPublicKey($publicKeyPath);
        $result = (bool)openssl_verify($text, base64_decode($sign), $publicKey, OPENSSL_ALGO_SHA1);
        openssl_free_key($publicKey);
        return $result;
    }
    
    /**
     *获取公匙的绝对路径
     * @param 参数1
     * @param 参数2
     * @return 返回类型
     * @author  trendpower
     */
    public function getPublicKeyPath()
    {
        return $this->publicKeyPath;
    }
}
