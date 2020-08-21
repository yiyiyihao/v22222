<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'/admin/public'],function(){
	Route::get('login','Admin\PublicController@login')->name('login');
	Route::post('check','Admin\PublicController@check');
    Route::get('logout','Admin\PublicController@logout');

});


//登入后的路由
Route::group(['prefix'=>'admin','middleware'=>['auth:admin','rbac']],function(){
	Route::get('index/index','Admin\IndexController@index');
	Route::get('index/welcome','Admin\IndexController@welcome');
	Route::any('index/getVenueStatistics','Admin\IndexController@getVenueStatistics');
	//管理员列表
	Route::get('manager/index','Admin\ManagerController@index');
	Route::any('manager/add','Admin\ManagerController@add');
	Route::any('manager/edit','Admin\ManagerController@edit');
	//权限列表
	Route::get('auth/index','Admin\AuthController@index');
	Route::any('auth/add','Admin\AuthController@add');
	Route::any('auth/app','Admin\AuthController@app');
	Route::any('auth/addAppAuth','Admin\AuthController@addAppAuth');
	//角色列表
	Route::get('role/index','Admin\RoleController@index');
	Route::any('role/add','Admin\RoleController@add');
	Route::any('role/edit','Admin\RoleController@edit');
	//权限分派操作
	Route::any('role/assign','Admin\RoleController@assign');
	Route::any('role/assignApp','Admin\RoleController@assignApp');
	//上传图片
	Route::post('uploader/webuploader','Admin\UploaderController@webuploader');
	Route::post('uploader/qiniu','Admin\UploaderController@qiniu');

    //管理员重置密码
    Route::any('manager/setpassword','Admin\ManagerController@setPassword');

/*******************************************************************************************/
    //门店
    Route::get('store/index','Admin\StoreController@index');
    Route::any('store/add','Admin\StoreController@add');
    Route::any('store/edit','Admin\StoreController@edit');
    Route::post('store/del','Admin\StoreController@del');
    //商品
    Route::get('goods/index','Admin\GoodsController@index');
    Route::any('goods/add','Admin\GoodsController@add');
    Route::any('goods/edit','Admin\GoodsController@edit');
    Route::post('goods/del','Admin\GoodsController@del');
    //商品分类
    Route::get('category/index','Admin\CategoryController@index');
    Route::any('category/add','Admin\CategoryController@add');
    Route::any('category/edit','Admin\CategoryController@edit');
    Route::post('category/del','Admin\CategoryController@del');
    //商品规格
    Route::get('goodsSpec/index','Admin\GoodsSpecController@index');
    Route::any('goodsSpec/add','Admin\GoodsSpecController@add');
    Route::any('goodsSpec/edit','Admin\GoodsSpecController@edit');
    Route::post('goodsSpec/del','Admin\GoodsSpecController@del');


});

