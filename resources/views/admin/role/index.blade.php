﻿{{--<!DOCTYPE HTML>--}}
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>角色管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l">
		{{--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> --}}
		<a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','/admin/role/add','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span>
	</div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="100">角色名</th>
				<th>权限集合</th>
				<th width="300">控制器/方法</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $v)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{{$v->id}}</td>
				<td>{{$v->role_name}}</td>
				@if($v->id == 1)
					<td>全部权限</td>
					<td>全部权限</td>
				@else
					<td><a href="#">{{$v->auth_ids}}</a></td>
					<td>{{$v->auth_ac}}</td>
				@endif
				<td class="f-14">
					<a  @if($v->id == 1) hidden @endif title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','/admin/role/edit','{{$v->id}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					<a  @if($v->id == 1) hidden @endif title="分派权限" href="javascript:;" onclick="admin_role_assign('权限分派','/admin/role/assign','{{$v->id}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe654;</i></a>
					<a  @if($v->id == 1) hidden @endif title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url + '?id=' + id,w,h);
}
/*管理员-角色-权限分派*/
function admin_role_assign(title,url,id,w,h){
	layer_show(title,url + '?id=' + id,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
/*员工-编辑*/
function admin_edit(title, url, id, w, h) {
    layer_show(title, url, w, h);
}
/*员工-停用*/
function admin_stop(obj, id) {
    layer.confirm('确认要停用吗？', function(index) {
        //此处请求后台程序，下方是成功后的前台处理……

        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
        $(obj).remove();
        layer.msg('已停用!', { icon: 5, time: 1000 });
    });
}

/*员工-启用*/
function admin_start(obj, id) {
    layer.confirm('确认要启用吗？', function(index) {
        //此处请求后台程序，下方是成功后的前台处理……


        $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
        $(obj).remove();
        layer.msg('已启用!', { icon: 6, time: 1000 });
    });
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable({
            "aoColumnDefs":[{"bSortable":false,"aTargets":[0]}],
            "order":[[1,"asc"]],
        });
    });
</script>
</body>
</html>