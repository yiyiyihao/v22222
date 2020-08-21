<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'admin_auth';
    public $timestamp = false;
}
