<!--_meta 作为公共模版分离出去-->
{{--<!DOCTYPE HTML>--}}
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/admin/webuploader-0.1.5/webuploader.css">
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->
    <title>添加门店 - H-ui.admin v3.1</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>门店名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$data->store_name}}" placeholder="门店名称" id="store_name" name="store_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>门店地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$data->address}}" placeholder="门店地址" id="address" name="address">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>保证金金额（元）：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$data->security_money}}" placeholder="保证金金额" id="security_money" name="security_money">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" value="1" id="gender-1" @if($data->status == 1) checked @endif >
                    <label for="gender-1">使用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="gender-2" value="2" name="status" @if($data->status == 2) checked @endif >
                    <label for="gender-2">未使用</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">门店logo ：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dev id="uploader-demo10">
                    <dev id="fileListWU_FILE_10" class="uploader-list"></dev>
                    <dev class="filePicker" id="abc">选择图片</dev>
                    <input type="hidden" name="logo" class="selecti" value="{{$data->logo}}" id="" />
                    <img src="{{$data->logo}}" width="200px" class="thumbnail" />
                </dev>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">法人身份证（国徽面）：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dev id="uploader-demo0">
                    <dev id="fileListWU_FILE_0" class="uploader-list"></dev>
                    <dev class="filePicker" id="abc">选择图片</dev>
                    <input type="hidden" name="idcard_back_img" class="selecti" value="{{$data->idcard_back_img}}" id="" />
                    <img src="{{$data->idcard_back_img}}" width="200px" class="thumbnail" />
                </dev>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">法人身份证（信息面）：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dev id="uploader-demo1">
                    <dev id="fileListWU_FILE_1" class="uploader-list"></dev>
                    <dev class="filePicker" id="hhh">选择图片</dev>
                    <input type="hidden" name="idcard_font_img" class="selecti" value="{{$data->idcard_font_img}}" />
                    <img src="{{$data->idcard_font_img}}" width="200px" class="thumbnail" />
                </dev>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">营业执照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dev id="uploader-demo2">
                    <dev id="fileListWU_FILE_2" class="uploader-list"></dev>
                    <dev class="filePicker">选择图片</dev>
                    <input type="hidden" name="license_img" class="selecti" value="{{$data->license_img}}" id="" />
                    <img src="{{$data->license_img}}" width="200px" class="thumbnail" />
                </dev>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">合同照片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <dev id="uploader-demo3">
                    <dev id="fileList3" class="uploader-list"></dev>
                    <dev class="filePicker">选择图片</dev>
                    <input type="hidden" name="signing_contract_img" class="selecti" value="{{$data->signing_contract_img}}" id="" />
                    <img src="{{$data->signing_contract_img}}" width="200px" class="thumbnail" />
                </dev>
            </div>
        </div>
        <!-- csrf值 -->
        {{csrf_field()}}
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/admin/webuploader-0.1.5/webuploader.js"></script>
<script type="text/javascript">
    var _token = "{{csrf_token()}}";
</script>
<script type="text/javascript" src="/admin/js/webuploader.js"></script>
<script type="text/javascript">
    $(function() {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-member-add").validate({
            rules: {
                store_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                logo: {
                    required: true,
                    minlength: 6,
                },
                address: {
                    required: true,
                },
                idcard_back_img: {
                    required: true,
                },
                idcard_font_img: {
                    required: true,
                },
                license_img: {
                    required: true,
                },
                signing_contract_img: {
                    required: true,
                },
                security_money: {
                    required: true,
                }
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "" ,	//提交给当前地址
                    success: function(data){
                        //判断返回值code
                        if(data.code == '0'){
                            //成功
                            layer.msg(data.msg,{icon:1,time:2000},function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                // parent.$('.btn-refresh').click();
                                parent.location.href = parent.location.href;
                                parent.layer.close(index);
                            });
                        }else{
                            //失败
                            layer.msg(data.msg,{icon:5,time:2000});
                        }
                    },
                    error: function(XmlHttpRequest, textStatus, errorThrown){
                        layer.msg('error!',{icon:5,time:2000});
                    }
                });
            }
        });
    });
</script>

<!--/请在上方写此页面业务相关的脚本-->
</body>

</html>