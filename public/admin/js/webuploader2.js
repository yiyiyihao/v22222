/**
 * 
 * @authors itcast.cn (you@example.org)
 * @date    2018-04-19 09:33:52
 * @version $Id$
 */

// 图片上传demo
jQuery(function() {
    var $ = jQuery,
        $list = $('#fileList'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({
    	//追加csrf
    	formData: {
    		_token: _token,//使用变量替代csrf
    	},
        // 自动上传。
        auto: true,
        // swf文件路径
        swf: '/admin/webuploader-0.1.5/Uploader.swf',
        // 文件接收服务端。
        // server: '/admin/uploader/webuploader',
        //配置上传到七牛
        server: '/admin/uploader/qiniu',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var leng = $("#fileList").children("div").length;
        if(leng > 3){
            alert('已经超过限制数量！');
            return;
        }
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                '</div>'
                ),
            $img = $li.find('img');
        //移除之前的图片
        $('.thumbnail').remove();
        $list.append( $li );
        // 创建缩略图
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    // 第二个参数表示的ajax的返回值
    uploader.on( 'uploadSuccess', function( file , response ) {
        var leng = $("#fileList").children(".imagess").length;
        if(leng > 3){
            return;
        }
        $( '#'+file.id ).addClass('upload-state-done');
        //判断是否成功
        if(response.code == '0'){
        	//成功
        	layer.msg(response.msg,{icon: 1,time: 2000});
        	$('#avatar').val(response.url);
        }else{
        	//失败
        	layer.msg(response.msg,{icon: 5,time: 2000});
        }
    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

});