<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'admin_role';
    public $timestamps = false;

    public function assignAuth($params)
    {
    	$data['auth_ids'] = implode($params['auth_id'],',');
    	$auth = \App\Admin\Auth::where('pid','<>',0)
    		->whereIn('id',$params['auth_id'])
    		->select('controller','action')
    		->get();
    	$data['auth_ac'] = '';
    	foreach($auth as $k=>$v){
    		$data['auth_ac'] .= $v->controller . '@' . $v->action . ',';
    	}
    	$data['auth_ac'] = rtrim($data['auth_ac'],',');

    	return Role::where('id',$params['id'])->update($data);
    }

    public function store()
    {
        return $this->hasOne('App\Admin\Store','id','store_id');
    }
}
