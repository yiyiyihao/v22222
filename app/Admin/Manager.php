<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
    protected $table = 'admin_manager';
    use Authenticatable;

    public function role()
    {
        return $this->belongsToMany('App\Admin\Role', 'admin_manager_role', 'manager_id','role_id');
    }

    public function store()
    {
        return $this->belongsToMany('App\Admin\Store','admin_manager_store','manager_id','store_id');
    }

}
