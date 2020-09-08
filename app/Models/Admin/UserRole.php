<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "user_role";
    public $timestamps = false;
    //

    public function role()
    {
        return $this->hasOne('App\Models\Admin\Role');
    }
}
