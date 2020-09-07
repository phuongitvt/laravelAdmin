<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany("App\Menu","role_permission", 'id_role', 'id_permission');
    }
}
