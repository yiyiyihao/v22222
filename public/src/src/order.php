<?php
date_default_timezone_set("PRC");

$bizUserId = 'geren-003';
$bizUserId = 'qiye-002';
$bizUserId = md5('13566666666');
//充值
$orderNo = time();
$amount = 10;
$setNo = '200126';
$cardNo = '6217582000018312231';
 /*depositApply($bizUserId, $orderNo, $amount, $setNo, $cardNo);
die();*/ 
$orderNo = '1570846786';
$orderNo = '1570862919';
$orderNo = '1571456773';
 //确认支付（前台+密码验证版）
$result = pay($bizUserId, $orderNo, '192.168.1.1');
$urldata = http_build_query($result);
$url= 'http://116.228.64.55:6900/yungateway/frontTrans.do';
// $url= 'https://fintech.allinpay.com/yungateway/frontTrans.do';//正式环境
$jumpUrl = $url.'?'.$urldata;

echo '<a target="_blank" href="'.$jumpUrl.'">确认支付地址</a>';//点击当前地址去往签约页面
die();
 
/* //充值退款测试
$oriBizOrderNo = '1570862919';
$orderNo = time();
$result = depositRefund($bizUserId, $orderNo, $oriBizOrderNo, $amount);
die(); */

//托管代收申请
$orderNo = time();
// $orderNo = '1570848859';
// $toUserId = "geren-003";
$toUserId = 'geren-004';
/* $result = agentCollectApply($bizUserId, $orderNo, $setNo, 1, $toUserId);
die(); */
//1182852409647439872

//查询订单状态
/* $result = getOrderDetail($orderNo);
die(); */


//托管代收退款
/* $orderNo = '1570863486';
$oriBizOrderNo = $orderNo;
$orderNo = time();
$amount = 1;
$result = refund($bizUserId, $orderNo, $oriBizOrderNo, $amount);
die(); */


//托管代付
$batchNo = time() -1;
$orderNo = time();
$oriOrderNo = '1570873511';

// $result = batchAgentPay($batchNo, $orderNo, $oriOrderNo, $toUserId);
// die();


/* //提现
$orderNo = time();
$amount = 1;
//企业
$bizUserId = 'qiye-002';
$cardNo = '6212264000010667570';
$bankCardPro = 1;
//个人
$bizUserId = 'geren-003';
$cardNo = '6230582000078655894';
$bankCardPro = 0;
$result = withdrawApply($bizUserId, $orderNo, $setNo, $amount, $cardNo, $bankCardPro);
die(); */
function depositRefund($bizUserId, $orderNo, $oriBizOrderNo, $amount)
{
    echo '退款(充值订单退款)===========================<br>';
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'refund',//调用方法
        'param'     => [
            'bizOrderNo'    => strval($orderNo),
            'oriBizOrderNo' => strval($oriBizOrderNo),//商户原订单号 需要退款的原交易订单号
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号。退款收款人
            'refundType'    => 'D0',//默认 D1 D1：D+1 14:30 向渠道发起退款 D0：D+0 实时向渠道发起退款
            'backUrl'       => 'http://www.test.com',
            'amount'        => $amount,
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}
function refund($bizUserId, $orderNo, $oriBizOrderNo, $amount)
{
    echo '退款(托管代收订单退款)===========================<br>';
    $recieverList = [
        [
            "accountSetNo"  => '200126',
            "bizUserId"     => 'geren-003',
            "amount"        => $amount,
        ],
    ];
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'refund',//调用方法
        'param'     => [
            'bizOrderNo'       => strval($orderNo),
            'oriBizOrderNo'    => strval($oriBizOrderNo),//商户原订单号 需要退款的原交易订单号
            'bizUserId'        => $bizUserId,//商户系统用户标识，商户系统中唯一编号。退款收款人
            'refundType'       => 'D0',//默认 D1 D1：D+1 14:30 向渠道发起退款 D0：D+0 实时向渠道发起退款
            'refundList'       => $recieverList,//托管代收订单中的收款人的退款金额
            'backUrl'   => 'http://www.test.com',
            'amount'    => $amount,
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}

function getOrderDetail($orderNo)
{
    echo '查询订单状态===========================<br>';
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'getOrderDetail',//调用方法
        'param'     => [
            'bizOrderNo'       => strval($orderNo),
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}

//提现
function withdrawApply($bizUserId, $orderNo, $setNo, $amount, $cardNo, $bankCardPro)
{
    echo '提现===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'withdrawApply',//调用方法
        'param'     => [
            'bizOrderNo'        => strval($orderNo),
            'bizUserId'         => $bizUserId,
            'accountSetNo'      => $setNo,
            'amount'            => $amount,
            'fee'               => 0,
            'validateType'      => 0,
            'backUrl'           => 'www.baidu.com',
            'orderExpireDatetime'=> date('Y-m-d H:i:s',time()+3600),
            'bankCardNo'        => strtoupper($rsa->encrypt($cardNo, 'hex')),
            'bankCardPro'       => $bankCardPro,//0：个人银行卡 1：企业对公账户 如果不传默认为 0 平台提现，必填 1
            'withdrawType'      => 'D0',//D0：D+0 到账 D1：D+1 到账  T1customized：T+1 到账，仅工作日代付 D0customized：D+0 到账，根据平台资金头寸付款 默认为 D0
            'industryCode'      => '1910',
            'industryName'      => '其他',
            'source'            => 2,
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}
//确认支付
function pay($bizUserId, $bizOrderNo, $consumerIp)
{
    echo '确认支付===========================<br>';
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'pay',//调用方法
        'param'     => [
            'bizUserId'     => $bizUserId,//商户系统用户标识，商户系统中唯一编号(注意1.不能输入“中文” 2.不要使用系统保留用户标识：#yunBizUserId_B2C#)
            'bizOrderNo'       => $bizOrderNo,
            'consumerIp' => $consumerIp,
        ],
    ];
    return $result = request($params, 1);
}
function batchAgentPay($batchNo, $orderNo, $oriOrderNo, $toUserId)
{
    echo '代付===========================<br>';
    $list = [
        [
            "bizOrderNo" => strval($orderNo),//商户订单号（支付订单）
            "collectPayList" => [//源托管代收订单付款信息 最多支持 100 个
                [
                    'bizOrderNo'    => strval($oriOrderNo),//相关代收交易的“商户订单号”
                    'amount'=>'1'
                ],
            ],
            "bizUserId" => $toUserId,//商户系统用户标识，商户系统中唯一编号。托管代收订单中指定的收款方。
            "accountSetNo" => "200126",//收款方的账户集编号
            "backUrl" => "http://yjs.company.weiput.com",
            "amount" => "1",
            "fee" => "0",
        ],
    ];
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'batchAgentPay',//调用方法
        'param'     => [
            'bizBatchNo'       => strval($batchNo),//商户批次号
            'batchPayList'     => json_decode(json_encode($list)),//批量代付列表
            'tradeCode'        => '4001',
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}
function depositApply($bizUserId, $orderNo, $amount = 1, $setNo = '200126', $cardNo)
{
    echo '充值申请===========================<br>';
    include_once 'Crypt/RSA1.php';
    $pubfile = getcwd().'/cert/TLYunstCert_test.cer';
    $prifile = getcwd().'/cert/1902271423530473681.pfx';
    $rsa = new RSA1($pubfile, $prifile);
    $info = [
        'GATEWAY_VSP'=>[
//             'gateid'=> '0103',//支付银行
            'amount' => $amount,
            'paytype' => 'B2C,B2B'//B2C 个人网银/B2B 企业网银
        ],
        /*'GATEWAY_VSP'=>[
            'gateid'=> '0104',//中国银行
            'amount' => $amount,
            'paytype' => 'B2B'//B2C 个人网银/B2B 企业网银
        ], */
        /*'QUICKPAY_TLT'=>[
            'bankCardNo'=> strtoupper($rsa->encrypt($cardNo, 'hex')),//中国银行
            'amount' => $amount,
        ],*/
//         'QUICKPAY_VSP'=>[//快捷支付仅支持个人会员,不支持企业对公银行卡
//             'bankCardNo'=> strtoupper($rsa->encrypt($cardNo, 'hex')),
//             'amount' => $amount,
//         ],
    ];
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'depositApply',//调用方法
        'param'     => [
            'bizOrderNo'        => strval($orderNo),
            'bizUserId'         => $bizUserId,
            'accountSetNo'      => $setNo,
            'amount'            => $amount,
            'fee'               => 0,//收续费
            'validateType'      => 0,//交易验证方式
            'backUrl'           => 'www.baidu.com',
            'frontUrl'          => 'www.baidu.com',
            'industryCode'      => '1910',
            'industryName'      => '其他',
            'source'            => 2,
            'payMethod'         => json_decode(json_encode($info)),
        ],
    ];
    pre($params, 1);
    return $result = request($params);
}
function agentCollectApply($bizUserId, $orderNo, $setNo, $amount = 1, $toUserId)
{
    echo '代收申请===========================<br>';
    $balance = [//账户余额
        [
            'accountSetNo'=> $setNo,
            'amount' => $amount,
        ]
    ];
    $info = [
//         'GATEWAY_VSP'=>[//网关支付
//             'gateid'=> '0103',
//             'amount' => 10,
//             'paytype' => 'B2B'
//         ],
        'BALANCE'=> json_decode(json_encode($balance)),
    ];
    $recieverList = [
        [
            "bizUserId" => $toUserId,
            "amount"    => $amount
        ],
    ];
    $params = [
        'service'   => 'OrderService',//服务对象
        'method'    => 'agentCollectApply',//调用方法
        'param'     => [
            'bizOrderNo'        => strval($orderNo),
            'payerId'           => $bizUserId,
            'recieverList'      => $recieverList,
            'tradeCode'     => '3001',//业务码
            'amount'        => $amount,
            'fee'           => 0,
            'validateType'  => 0,//交易验证方式  无验证 0 整型 仅渠道验证，通商云不做交易验证   短信验证码1 整型 通商云发送并验证短信验证码，有效期 3 分钟。 支付密码 2
            'backUrl'       => 'www.baidu.com',
//             'frontUrl'       => 'www.baidu.com',
            'industryCode'  => '1910',
            'industryName'  => '其他',
            'source'        => 2,
//             'payMethod'     => json_decode(json_encode($info)),
            'payMethod'     => $info,
        ],
    ];
    pre($params, 1);
//     die();
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