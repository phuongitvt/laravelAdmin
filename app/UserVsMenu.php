<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVsMenu extends Model
{
    //
    protected $table="user_vs_menus";

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
