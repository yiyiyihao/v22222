<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('member',function($table){
            $table -> increments('id');     //主键
            $table -> string('username',20) -> notNull();   //用户名
            $table -> string('password') -> notNull();  //密码
            $table -> enum('gender',[1,2,3]) -> nutNull() -> default('1'); //性别
            $table -> string('mobile',11) -> nullable();  //手机号
            $table -> string('email',40) -> nullable();//邮箱
            $table -> string('avatar') -> nullable();//头像文件的路径
            $table -> timestamps(); //时间字段
            $table -> rememberToken();  //记住我
            $table -> enum('type',[1,2]) -> notNull() -> default('1');  //帐号类型
            $table -> enum('status',[1,2]) -> notNull() -> default('2'); //状态
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删表
        Schema::dropIfExists('member');
    }
}
