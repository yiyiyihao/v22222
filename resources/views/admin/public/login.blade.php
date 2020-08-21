<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>智享家登录</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/admin/login/common.css"/>
    <link rel="stylesheet" href="/admin/login/adminLogin.css"/>
    <link rel="stylesheet" href="/admin/login/layer.css"/>
    <script src="/admin/login/jquery.js"></script>
    <script src="/admin/login/layer.js"></script>
</head>
<body>
<div class="login">
    <div class="login-box">
        <h1>登录</h1>
        <p class="login-sub-title">欢迎登录智享家零售管理系统</p>
        <form id="form" action="/admin/public/check" method="post">
            <div class="form-group">
                <div class="input-line">
                    <img src="/admin/login/images/user.png">
                    <input type="text" class="input" id="username" name="username" size="20" maxlength="30"  datatype="*"  value="" nullmsg="请输入用户名！" placeholder="请输入用户名" />
                </div>
            </div>
            <div class="form-group">
                <div class="input-line">
                    <img src="/admin/login/images/lock.png">
                    <input type="password" class="input" id="password" name="password" size="20" maxlength="30" datatype="*5-20" value="" nullmsg="请输入您的登陆密码！" errormsg="密码需在6-20位！" placeholder="请输入密码"/>
                </div>
            </div>
            <div id="tips"></div>
            {{csrf_field()}}
            <button class="button button-large button-block bg-blue text-big button-login" type="submit">登录</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var err = '';
        @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
            err += "{{$error}}<br />";
        @endforeach
        layer.alert(err,{icon:5,title:'错误'});
        @endif

    });
</script>
</body>
</html>