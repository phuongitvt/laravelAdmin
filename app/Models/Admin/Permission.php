<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name',"full_name",'id_slug','description'];

    public function roles()
    {
        return $this->belongsToMany("App\Models\AdminMenu","role_permission", 'id_permission','id_role');
    }
}
