﻿{{--<!DOCTYPE HTML>--}}
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
    <!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <title>管理后台</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="">管理后台</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">后台</a>
                <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span>
                <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
                {{--<nav class="nav navbar-nav">--}}
                    {{--<ul class="cl">--}}
                        {{--<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>--}}
                            {{--<ul class="dropDown-menu menu radius box-shadow">--}}
                                {{--<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>--}}
                                {{--<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>--}}
                                {{--<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>--}}
                                {{--<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        @foreach(Auth::guard('admin') -> user() -> role as $value)
                            @if($value->store_id == 0)
                                <li>{{$value-> role_name}}</li>
                            @endif
                        @endforeach
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A">{{Auth::guard('admin') -> user() -> username}} <i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                                {{--<li><a href="#">切换账户</a></li>--}}
                                <li><a href="/admin/public/logout">退出</a></li>
                            </ul>
                        </li>
                        {{--<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>--}}
                        <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                                <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                                <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
                        {{--<dl id="menu-article">
                            <dt><i class="Hui-iconfont">&#xe616;</i> 专业管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="/admin/protype/index" data-title="分类管理" href="javascript:void(0)">分类管理</a>
                                    </li>
                                    <li><a data-href="/admin/profession/index" data-title="专业列表" href="javascript:void(0)">专业列表</a>
                                </li>
                                </ul>
                            </dd>
                        </dl>
                        <dl id="menu-picture">
                            <dt><i class="Hui-iconfont">&#xe613;</i> 课程管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="/admin/course/index" data-title="课程管理" href="javascript:void(0)">课程管理</a></li>
                                    <li><a data-href="/admin/lesson/index" data-title="点播管理" href="javascript:void(0)">点播管理</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl id="menu-product">
                            <dt><i class="Hui-iconfont">&#xe620;</i> 试卷管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="/admin/paper/index" data-title="试卷管理" href="javascript:void(0)">试卷管理</a></li>
                                    <li><a data-href="/admin/question/index" data-title="试题管理" href="javascript:void(0)">试题管理</a></li>
                                    <li><a data-href="" data-title="答题卡管理" href="javascript:void(0)">答题卡管理</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl id="menu-comments">
                            <dt><i class="Hui-iconfont">&#xe622;</i> 直播管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="/admin/stream/index" data-title="流列表" href="javascript:;">流列表</a></li>
                                    <li><a data-href="/admin/live/index" data-title="直播课程列表" href="javascript:void(0)">直播课程列表</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl id="menu-member">
                            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="/admin/member/index" data-title="会员列表" href="javascript:;">会员列表</a></li>
                                    <li><a data-href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
                                    <li><a data-href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
                                    <li><a data-href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
                                    <li><a data-href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
                                    <li><a data-href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
                                    <li><a data-href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
                                </ul>
                            </dd>
                        </dl>--}}
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60a;</i> 组织管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/role/index" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                        <li><a data-href="/admin/auth/index" data-title="权限列表" href="javascript:void(0)">权限列表</a></li>
                        <li><a data-href="/admin/manager/index" data-title="用户列表" href="javascript:void(0)">用户列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60a;</i> 门店管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/store/index" data-title="门店列表" href="javascript:void(0)">门店列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60a;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/goods/index" data-title="商品列表" href="javascript:void(0)">商品列表</a></li>
                        <li><a data-href="/admin/category/index" data-title="商品分类" href="javascript:void(0)">商品分类</a></li>
                        <li><a data-href="/admin/goodsSpec/index" data-title="商品规格" href="javascript:void(0)">商品规格</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60a;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/role/index" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                        <li><a data-href="/admin/auth/index" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                        <li><a data-href="/admin/manager/index" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60a;</i> 工单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/role/index" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                        <li><a data-href="/admin/auth/index" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                        <li><a data-href="/admin/manager/index" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                    </ul>
                </dd>
            </dl>
{{--            <dl id="menu-venue">
                <dt><i class="Hui-iconfont">&#xe643;</i> 场馆管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/venue/index" data-title="场馆列表" href="javascript:void(0)">场馆列表</a></li>
                        <li><a data-href="/admin/equipment/index" data-title="器材列表" href="javascript:void(0)">器材列表</a></li>
                        <li><a data-href="/admin/lesson/index" data-title="训练教学" href="javascript:void(0)">训练教学</a></li>
                        <li><a data-href="/admin/dynamic/index" data-title="场馆动态" href="javascript:void(0)">场馆动态</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-manager">
                <dt><i class="Hui-iconfont">&#xe60d;</i> 员工管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/staffer/index" data-title="员工列表" href="javascript:void(0)">员工列表</a></li>
                    </ul>
                </dd>
            </dl>
                        --}}{{--<dl id="menu-tongji">
                            <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                            <dd>
                                <ul>
                                    <li><a data-href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>
                                    <li><a data-href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
                                    <li><a data-href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
                                    <li><a data-href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
                                    <li><a data-href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
                                    <li><a data-href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
                                    <li><a data-href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
                                </ul>
                            </dd>
                        </dl>--}}{{--
            <dl id="menu-admin">
                <dt><i class="Hui-iconfont">&#xe62d;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/user/index" data-title="用户列表" href="javascript:void(0)">用户列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-article">
                <dt><i class="Hui-iconfont">&#xe616;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/order/index" data-title="订单列表" href="javascript:void(0)">订单列表</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-system">
                <dt><i class="Hui-iconfont">&#xe613;</i> 人脸库<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/img/userImgs" data-title="用户人脸库" href="javascript:void(0)">用户人脸库</a></li>
                        <li><a data-href="/admin/img/strangerImgs" data-title="陌生人人脸库" href="javascript:void(0)">陌生人人脸库</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-system">
                <dt><i class="Hui-iconfont">&#xe606;</i> 考勤管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/attendance/classes" data-title="考勤班次" href="javascript:void(0)">考勤班次</a></li>
                        <li><a data-href="/admin/attendance/rule" data-title="考勤规则" href="javascript:void(0)">考勤规则</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-system">
                <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a data-href="/admin/manager/setpassword" data-title="帐号管理" href="javascript:void(0)">帐号管理</a></li>
                        <li><a data-href="/admin/manager/operationlog" data-title="操作日志" href="javascript:void(0)">操作日志</a></li>
                        <li><a data-href="/admin/timeInterval/index" data-title="设置预约时间段" href="javascript:void(0)">设置预约时间段</a></li>
                    </ul>
                </dd>
            </dl>--}}
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="我的桌面" data-href="/admin/index/welcome">我的桌面</span>
                        <em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="/admin/index/welcome"></iframe>
            </div>
        </div>
    </section>
    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前 </li>
            <li id="closeall">关闭全部 </li>
        </ul>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
    <script type="text/javascript">
    $(function() {
        /*$("#min_title_list li").contextMenu('Huiadminmenu', {
        	bindings: {
        		'closethis': function(t) {
        			console.log(t);
        			if(t.find("i")){
        				t.find("i").trigger("click");
        			}		
        		},
        		'closeall': function(t) {
        			alert('Trigger was '+t.id+'\nAction was Email');
        		},
        	}
        });*/
    });
    /*个人信息*/
    function myselfinfo() {
        layer.open({
            type: 1,
            area: ['300px', '200px'],
            fix: false, //不固定
            maxmin: true,
            shade: 0.4,
            title: '查看信息',
            content: '<div>管理员信息</div>'
        });
    }

    /*资讯-添加*/
    function article_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-添加*/
    function picture_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-添加*/
    function product_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    </script>
</body>

</html>