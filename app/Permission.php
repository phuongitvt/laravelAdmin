<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name','id_slug','description'];

    public function roles()
    {
        return $this->belongsToMany("App\Menu","role_permission", 'id_permission','id_role');
    }
}
