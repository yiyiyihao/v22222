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
    <title>修改密码 - H-ui.admin v3.1</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
    <article class="page-container">
        <h1 align="center">修改密码</h1>
        <form action="" method="post" class="form form-horizontal" id="form-member-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" readOnly="true" value="{{Auth::guard('admin')->user()->username}}" placeholder="用户名" id="username" name="username">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>原密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" value="" placeholder="密码" id="password" name="password">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" value="" placeholder="新密码" id="new_password" name="new_password">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" value="" placeholder="确认密码" id="new_password_confirmation" name="new_password_confirmation">
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

        //给国家绑定一个change事件
        $('select[name=country_id]').change(function(){
            //获取id
            var _id = $(this).val();
            //ajax请求
            $.get('/admin/member/getAreaById',{id: _id},function(data){
                //循环json数据
                var _options = '';
                $.each(data,function(index,el){
                    //index是当前遍历到的索引，el是当前遍历到的元素
                    _options += "<option value='" + el.id + "'>" + el.area + "</option>";
                });
                // console.log(_options);
                // 复原后续的选择框到原始为空的状态
                $('select[name=province_id]').find('option:gt(0)').remove();
                $('select[name=city_id]').find('option:gt(0)').remove();
                $('select[name=county_id]').find('option:gt(0)').remove();
                // 追加内容到省份的select中
                $('select[name=province_id]').append(_options);
            },'json');
        });

        //给省份绑定change事件
        $('select[name=province_id]').change(function(){
            //获取id
            var _id = $(this).val();
            //ajax请求
            $.get('/admin/member/getAreaById',{id: _id},function(data){
                //循环json数据
                var _options = '';
                $.each(data,function(index,el){
                    //index是当前遍历到的索引，el是当前遍历到的元素
                    _options += "<option value='" + el.id + "'>" + el.area + "</option>";
                });
                // console.log(_options);
                // 复原后续的选择框到原始为空的状态
                $('select[name=city_id]').find('option:gt(0)').remove();
                $('select[name=county_id]').find('option:gt(0)').remove();
                // 追加内容到省份的select中
                $('select[name=city_id]').append(_options);
            },'json');
        });

        //给城市绑定change事件
        $('select[name=city_id]').change(function(){
            //获取id
            var _id = $(this).val();
            //ajax请求
            $.get('/admin/member/getAreaById',{id: _id},function(data){
                //循环json数据
                var _options = '';
                $.each(data,function(index,el){
                    //index是当前遍历到的索引，el是当前遍历到的元素
                    _options += "<option value='" + el.id + "'>" + el.area + "</option>";
                });
                // console.log(_options);
                // 复原后续的选择框到原始为空的状态
                $('select[name=county_id]').find('option:gt(0)').remove();
                // 追加内容到省份的select中
                $('select[name=county_id]').append(_options);
            },'json');
        });

        $("#form-member-add").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                password: {
                    required: true,
                    minlength: 6,
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
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                parent.location.reload();
                                //do something
                            });
                        }else{
							//失败
							layer.msg(data.msg,{icon:5,time:2000});
						}
					},
	                error: function(XmlHttpRequest, textStatus, errorThrown){
                        {{--var err = '';--}}
                        {{--@if(count($errors) > 0){--}}
                            {{--@foreach($errors ->all() as $error)--}}
                            {{--err += "{{$error}}<br/>";--}}
                            {{--@endforeach--}}
                            {{--layer.msg(err,{icon:5,time:2000});--}}
                        {{--}--}}
                        {{--@endif--}}
						layer.msg('新密码与确认密码不一致',{icon:5,time:2000});
					}
				});
            }
        });
    });
    </script>
    
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>