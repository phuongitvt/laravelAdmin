<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    //
    protected $table = "role_permission";

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
