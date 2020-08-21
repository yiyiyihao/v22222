<?php
date_default_timezone_set("PRC");

/*===========个人接口调试===================*/

// $bizUserId = 'geren-001';
// $signedValue = '{"userId":"c5638577-9769-41eb-aed8-2932f10ffb86","bizUserId":"geren-001"}';
// $bizUserId = 'geren-002';
$bizUserId = 'geren-003';
$bizUserId = 'geren-004';
$bizUserId = md5('13566666666');
//{"userId":"cc3cff9f-d39b-46c6-bd7b-8d5f6bf51f5b","bizUserId":"geren-003"}
$phone = '13566666666';
// //创建会员(个人)
// $result = createMember($bizUserId, 3, 2);
// die();
// $signedValue = '{"userId":"c7ff05d8-18e9-4355-abab-8c3ba43c12b4","bizUserId":"geren-002"}';

// //查询会员信息
// $result = getMemberInfo($bizUserId);
// $result['signedValue'] = $result['signedValue'] ? json_decode($result['signedValue'], 1) : [];
// pre($result, 1);
// //发送绑定手机短信验证码
$codeType = 9;
// sendVerificationCode($bizUserId, $phone, $codeType);die;
// //绑定手机
$code = '837275';
bindPhone($bizUserId, $phone, $code);die();
// //发送解绑手机短信验证码
// $codeType = 6;
// $result = sendVerificationCode($bizUserId, $phone, $codeType);
// //解绑手机
// $code = '803150';
// $result = unbindPhone($bizUserId, $phone, $code);

// //个人实名认证
$name = '刘亚君';
$identityType = '1';
$identityNo = '511622198902106145';
// $result = setRealName($bizUserId, $name, $identityType, $identityNo);
// $signedValue = '{"identityNo":"76683F157F1083010DE68F52C977FFAD10044B3A5269E978F1386A86B20B8BB94166475FC6261E595220C402D01052DADB018F4911CF88A22F69D61020ED07D9E632E95F9F98B6F96B66118128C3941F4FF2A15CB557335EC8B6A83729804F75E7CA2B13EC1C8712652831C204F168F96FED2DAF0E6CD133FC56FD5A9B30E0EF","identityType":1,"name":"刘亚君","bizUserId":"geren-001"}';
// $signedValue = '{"identityNo":"63370864BC1C24511D28F73A71B8C3A063F209C76D36765996EDE80F2DC23699E37402DF038B5BC721474800F796AC5795454EB71CFE48AE04C202E07CFF080EA4CC49488A02AD065829CEF45B4A46E857B377BEE0914A13D037016B67DCE79DA019CA07E4B5E10AFAB698D1E088486BF19647D4F397C11575290B3223CDB94C","identityType":1,"name":"刘亚君","bizUserId":"geren-002"}';
// //请求绑定银行卡

$cardNo = '6230582000078655894';
$cardCheck = 5;//不需要确认绑定
$result = applyBindBankCard($bizUserId, $cardNo, $cardCheck, $phone, $name, $identityType, $identityNo);
// $signedValue = '{"bankCode":"01030000","tranceNum":"D2019101153546","transDate":"20191011","cardType":1,"bankName":"农业银行","bizUserId":"geren-003"}';
// $result['signedValue'] = '{"bankCode":"01030000","tranceNum":"D2019101153543","transDate":"20191011","cardType":1,"bankName":"农业银行","bizUserId":"geren-002"}';
// $result['signedValue'] = $signedValue;
// $signedValue = $result['signedValue'] ? json_decode($result['signedValue'], 1) : [];
pre($result);

// //确认绑定银行卡
$code = '695496';
// $tranceNum = $signedValue['tranceNum'];
// $result = bindBankCard($bizUserId, $signedValue['tranceNum'], $signedValue['transDate'], $phone, $code);
// die();
// //解绑银行卡
// $result = unbindBankCard($bizUserId, $cardNo);

// //查询绑定银行卡
// $result = queryBankCard($bizUserId, $cardNo, $phone, $name, $identityType, $identityNo);

/* // //会员电子协议签约
// $jumpUrl = 'http://116.228.64.55:6900/yungateway/member/signContract.html';
$jumpUrl = 'http://test.com';//签约成功后跳转地址
$backUrl = 'http://test.com';//签约成功后异步通知地址
$result = signContract($bizUserId, $jumpUrl, $backUrl);
$urldata = http_build_query($result);
$url= 'http://116.228.64.55:6900/yungateway/member/signContract.html';
// $url= 'https://fintech.allinpay.com/yungateway/member/signContract.html';//正式环境
$jumpUrl = $url.'?'.$urldata;

echo '<a href="'.$jumpUrl.'">签约地址</a>';//点击当前地址去往签约页面
die(); */
/*===========企业接口调试===================*/
// //创建会员(企业)
$bizUserId = 'qiye-002';
// $result = createMember($bizUserId, 2, 2);
// die();
// {"userId":"ad431ab5-0238-499a-a282-c2457e6b2bb8","bizUserId":"qiye-001"}
// //查询会员信息
// $result = getMemberInfo($bizUserId);
// $result['signedValue'] = $result['signedValue'] ? json_decode($result['signedValue'], 1) : [];
// pre($result, 1);
// pre($result);
//查询企业信息
// $result = getMemberInfo($bizUserId);

//设置企业信息
$legalName = '刘畅';
$cardNo = '6212264000010667570';
$cardName = '工商银行';
$bankName = '深圳南山工商银行某支行';
$legalIds = '411502198807139016';
$phone = '18903769208';

// $result = setCompanyInfo($bizUserId, $legalName, $phone, $cardNo, $cardName, $bankName, $legalIds);
// //发送绑定手机短信验证码
$codeType = 9;
// sendVerificationCode($bizUserId, $phone, $codeType);
// //绑定手机
$code = '590347';
// bindPhone($bizUserId, $phone, $code);
// // //会员电子协议签约
// $jumpUrl = 'http://116.228.64.55:6900/yungateway/member/signContract.html';
$jumpUrl = 'http://test.com';//签约成功后跳转地址
$backUrl = 'http://test.com';//签约成功后异步通知地址
// $result = signContract($bizUserId, $jumpUrl, $backUrl);
// $urldata = http_build_query($result);
$url= 'https://fintech.allinpay.com/yungateway/member/signContract.html';//正式环境
// $url= 'http://116.228.64.55:6900/yungateway/member/signContract.html';
// $jumpUrl = $url.'?'.$urldata;

// echo '<a href="'.$jumpUrl.'">签约地址</a>';//点击当前地址去往签约页面

/* $result = queryBankCard($bizUserId, $cardNo, $phone, $name, $identityType, $identityNo);
die(); */

//企业绑定银行卡 
$cardNo = '6217582000018312231';
$cardCheck = 5;//不需要确认绑定
$result = applyBindBankCard($bizUserId, $cardNo, $cardCheck, $phone, $legalName, $identityType, $legalIds);
die();

function setCompanyInfo($bizUserId, $legalName, $phone, $cardNo, $cardName, $bankName, $legalIds)
{
    echo '设置企业信息===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    
    
    $info = [
        'companyName'       => '深圳市回响科技',
        'companyAddress'    => '深圳市南山区高新园',
//         'authType' => '1',//认证类型1:三证 2:一证 默认 1-三证
//         'businessLicense' => '1',//营业执照号（三证）认证类型为 1 时必传
//         'organizationCode' => '1',//组织机构代码（三证）认证类型为 1 时必传
//         'taxRegister' => '1',//税务登记证（三证）认证类型为 1 时必传
        'authType'  => 2,//认证类型1:三证 2:一证 默认 1-三证
        'uniCredit' => '111111111111111',//统一社会信用（一证）
        'legalName' => $legalName,//法人姓名
        'identityType'  => 1,//法人证件类型
        'legalIds'      => strtoupper($rsa->encrypt($legalIds, 'hex')),//法人证件号
        'legalPhone'    => $phone,//法人手机号
        'accountNo'     => strtoupper($rsa->encrypt($cardNo, 'hex')),//企业对公账户 RSA 加密，详细
        'parentBankName'=> $cardName,//开户银行名称，如：“工商银行” 注：测试环境仅支持工农中建交。
        'bankName'      => $bankName,//开户行支行名称 如：“中国工商银行股份有限公司北京樱桃园支行”
        'unionBank'     => '111111111111',//支付行号，12 位数字
    ];
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'setCompanyInfo',//调用方法
        'param'     => [
            'bizUserId'         => $bizUserId,  //商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
//             'backUrl'       => '',
            'companyBasicInfo'  => json_decode(json_encode($info)),
            'isAuth'            => true,
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}

//会员电子协议签约
function signContract($bizUserId, $jumpUrl, $backUrl)
{
    echo '会员电子协议签约===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'signContract',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'jumpUrl'       => $jumpUrl,
            'backUrl'       => $backUrl,
            'source'        => '2',
        ],
    ];
    return $result = request($params, 1);
}

function queryBankCard($bizUserId, $cardNo)
{
    echo '查询绑定银行卡===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'queryBankCard',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
//             'cardNo'        => strtoupper($rsa->encrypt($cardNo, 'hex')),//银行卡号
        ],
    ];
    return $result = request($params);
}
function unbindBankCard($bizUserId, $cardNo)
{
    echo '解绑绑定银行卡===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'unbindBankCard',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'cardNo'        => strtoupper($rsa->encrypt($cardNo, 'hex')),//银行卡号
        ],
    ];
    return $result = request($params);
}

function bindBankCard($bizUserId, $tranceNum, $transDate, $phone, $code)
{
    echo '确认绑定银行卡===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'bindBankCard',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'tranceNum'     => $tranceNum,
            'transDate'     => $transDate,
            'phone'         => $phone, 
            'verificationCode'=> $code,
        ],
    ];
    return $result = request($params);
}

function applyBindBankCard($bizUserId, $cardNo, $cardCheck, $phone, $name, $identityType, $identityNo)
{
    echo '请求绑定银行卡===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'applyBindBankCard',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'cardNo'        => strtoupper($rsa->encrypt($cardNo, 'hex')),//银行卡号
            'cardCheck'     => $cardCheck, //
            'phone'         => $phone, //
            'name'          => $name, // 姓名
            'identityType'  => $identityType,//证件类型（身份证 1 护照 2 军官证 3 回乡证 4 台胞证 5 警官证 6 士兵证 7 其它证件 99）
            'identityNo'    => strtoupper($rsa->encrypt($identityNo, 'hex')),//证件号码
        ],
    ];
    return $result = request($params);
}

function setRealName($bizUserId, $name, $identityType, $identityNo)
{
    echo '个人实名认证===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'setRealName',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'isAuth'        => 'true',//是否由通商云进行认证（true/false 默认为 true 目前必须通过通商云认证）
            'name'          => $name, // 姓名
            'identityType'  => $identityType,//证件类型（身份证 1 护照 2 军官证 3 回乡证 4 台胞证 5 警官证 6 士兵证 7 其它证件 99）
            'identityNo'    => strtoupper($rsa->encrypt($identityNo, 'hex')),//证件号码
        ],
    ];
    return $result = request($params);
}


function unbindPhone($bizUserId, $phone, $code)
{
    echo '解绑原手机号===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'unbindPhone',//调用方法
        'param'     => [
            'bizUserId'    => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'phone'        => $phone, // 原手机号码
            'verificationCode' => $code,//验证码
        ],
    ];
    return $result = request($params);
}
function bindPhone($bizUserId, $phone, $code)
{
    echo '绑定手机===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'bindPhone',//调用方法
        'param'     => [
            'bizUserId'    => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'phone'        => $phone, // 手机号码
            'verificationCode' => $code,//验证码
        ],
    ];
    return $result = request($params);
}

function sendVerificationCode($bizUserId, $phone, $codeType)
{
    echo '发送验证码===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'sendVerificationCode',//调用方法
        'param'     => [
            'bizUserId'    => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'phone'        => $phone, // 手机号码
            'verificationCodeType' => $codeType,//验证码类型(9-绑定手机6-解绑手机)
        ],
    ];
    return $result = request($params);
}
function getMemberInfo($bizUserId)
{
    echo '查询会员信息===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'getMemberInfo',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,  //商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
        ],
    ];
    return $result = request($params);
}
function createMember($bizUserId, $memberType, $source)
{
    echo '创建会员===========================<br>';
    $params = [
        'service'   => 'MemberService',//服务对象
        'method'    => 'createMember',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,  //商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'memberType'    => $memberType, //会员类型(企业会员 2 个人会员 3)
            'source'        => $source,     //访问终端类型(Mobile 1 PC 2)
        ],
    ];
    return $result = request($params);
}

function request($params, $return = FALSE)
{
    $sysid = "1902271423530473681";
    $req = json_encode($params);
    $timestamp = date("Y-m-d H:i:s", time());
    $content = $sysid . $req . $timestamp;
    echo '内容字符串:  '. $content;
    $str1 = hash('md5', $content, true);
    // $str1 =md5($content);
    $toSign = base64_encode($str1);
    $privateKey = "MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAND8nmCfyVILFNiQWjY/cJnL5H4qa1hFFz1c/WYWkpQPFwmObPfeD/DWjrRagR4Eac8INFcybvETnB/yoe3bgDdcM+okMBHPxQZnK0qtmk5mY0B4Q/4QAA+ExAeUsgQ7YVQYFSvEh2cItd5Nfs3rTYNsU3kGH/CY+SCXkk29K4E7AgMBAAECgYEAsu3G7/V+mabxNyYIhu+0CYmfXUIWXCHzbs9iCXkEEI4G7GCr/WB8B3i7/8CJUdj3epGMtqdwgymF/3humcbYM4G7N/sWsNA+xHlF0D4rLM3350oID1zuFYsLjNHEHpdbhaADWW9PniAfidHXuho01XsmDf3a7XQiJhL8OiUiSaECQQDqTJQ3PUd7NKZTFFUj6HQApQNp7hON+jjQ7lU0I1G2Lh8zFbLrBZoYvucFWvlyuEbBEdvKI5e1FQxynZJ9Y+FxAkEA5FfdFuMo+jCI2Qc+ceLk8ex6IzPOTHjYWn04FLxDyynnbDtRw+Y69wwMinAkAw+OU51w0Lqevp45GoeREE03awJAJmoBzwC8DIY4Uty9jNKa2lQzuBVxnVCOKis5SwATcJQlR2HiYMgdWLtL80PULCvsZdFAwOaPBAB8dvpAv1A18QJAEZPl9B4WiHP2BOb22qOBxlHS8STKy749wXGEQKxhd6FJLF7Ao5j0jxIBYSLS0t1+slcbWSYUlE3vzWgENcIL8wJAL4kKI7TdFsW8Pwn7vzNI1IPK7bBvkMZFuCUa1ivMouW6iVZg2BbMSvuji2Cpy+M7FbGA0JzbmmtI/wUcGElz3Q==";
    $sign = genSign($toSign, $privateKey);
    
    // 使用方法
    $post_data = array(
        'sysid'     => $sysid,  //分配的系统编号
        'timestamp' => $timestamp,//请求时间戳
        'v'         => "2.0",   //接口版本(现为 2.0)
        'req'       => $req,    //服务请求的 JSON 对象，参与签名，非必填参数在报文可出现，也可不出现
        'sign'      => $sign    //签名
    );
    if ($return) {
        return $post_data;
    }
    pre($post_data, 1);
    $result = send_post('http://116.228.64.55:6900/service/soa', $post_data);
    $result = $result ? json_decode($result, 1) : [];
    pre($result, 1);
    return $result;
}


function pre($params = [], $return = FALSE)
{
    echo '<pre>';
    print_r($params);
    echo '</pre>';
    if (!$return) {
        die();
    }
}

// $sign = base64_encode($str3);
function send_post($url, $post_data)
{
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 * 100 // 超时时间（单位:s）
        )
    );
    
    $context = stream_context_create($options);
    
    $result = file_get_contents($url, false, $context);
    
    return $result;
}

function genSign($toSign, $privateKey)
{
    $privateKey = "-----BEGIN PRIVATE KEY-----\n" . wordwrap($privateKey, 64, "\n", true) . "\n-----END PRIVATE KEY-----";
    
    $key = openssl_get_privatekey($privateKey);
    openssl_sign($toSign, $signature, $key);
    openssl_free_key($key);
    $sign = base64_encode($signature);
    return $sign;
}

function getSign($toSign, $privateKey)
{
    $signature = "";
    $str = chunk_split($privateKey, 64, "\n");
    $key = "-----BEGIN PRIVATE KEY-----\n$str-----END PRIVATE KEY-----\n";
    openssl_sign($toSign, $signature, $key);
    
    return base64_encode($signature);
}
?>