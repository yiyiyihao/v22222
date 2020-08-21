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
    <link rel="stylesheet" type="text/css" href="/admin/css/tag.css">
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->
    <title>添加规格 - H-ui.admin v3.1</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>规格名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="规格名称" id="cate_name" name="cate_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" class="input-text" value="" placeholder="排序" id="sort" name="sort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>规格：</label>
            <div class="field">
                <span class="button-group">
                    <input type="text"  id="spec-name" placeholder="请输入规格属性,如 红色" class="input" size="30">
                    <input type="button" id="spec-add" class="input icon-plus bg-main" value="添加" style="border: none !important;">
                    <div class="input-note"></div>
                </span>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <div class="button-group clear spec-group ">
                        {{--{notempty name="info.value"}--}}
                        {{--{volist name="info.value" id="vo" key="k"}--}}
                        <span class="pop-box">
                                    {{--<input  type="hidden"  value="{$vo|trim}" name="specname[]" />--}}
                                    {{--<div class="pop-content pop-border">{$vo|trim}</div>--}}
                                    <div class="pop-content pop-border"></div>
                                    <i class="pop-close"></i>
                                </span>
                        {{--{/volist}--}}
                        {{--{/notempty}--}}
                    </div>
                    <div class="input-note"></div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" value="1" id="status-1">
                    <label for="status-1">禁用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="status-2" value="0" name="status" checked>
                    <label for="status-2">启用</label>
                </div>
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
<style>
    #spec-add{
        display: inline-block;
        height: 30px;
        line-height: 15px;
    }
</style>

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
<script>
    $(function(){
        $('.spec-group').on('click','.pop-close',function () {
            $(this).parent('.pop-box').remove();
        });

        var specName=$('#spec-name');
        $('#spec-add').click(function () {
            var name=specName.val();
            if (!name){
                specName.focus();
                show_err(specName,'请输入规格值',false);
                return false;
            }
            var html='<span class="pop-box">' +
                '<input  type="hidden"  value="'+name+'" name="specname[]" />' +
                '<div class="pop-content pop-border">'+name+'</div>' +
                '<i class="pop-close"></i>' +
                '</span>';
            $('.spec-group').append(html);
            specName.val('');
        });
        specName.change(function () {
            var len=$('.pop-box').length;
            if (len>0){
                hide_err($(this));
            }
        });
    });
    function show_err(obj,msg,flag) {
        if (flag){
            var html = '<div class="alert alert-yellow"><strong>注意：</strong>您填写的信息未通过验证，请检查后重新提交！</div>';
            $('#tips').html(html);
        }
        var objtip=obj.siblings(".input-note");
        var className = 'check-error';
        if ( objtip.next('.js-tip').length == 0 ) {
            objtip.after('<div class="input-note js-tip">' + msg + '</div>');
            objtip.hide();
            obj.parents('.form-group').addClass(className);
        }
    }

    function hide_err(obj) {
        $('#tips').html('');
        var objtip=obj.siblings(".input-note");
        objtip.next('.js-tip').remove();
        obj.parents('.form-group').removeClass('check-error');
        objtip.show();
    }
</script>
<script type="text/javascript">
    $(function() {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-member-add").validate({
            rules: {
                cate_name: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                mobile: {
                    required: true,
                    isMobile: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                avatar: {
                    required: true,
                },

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