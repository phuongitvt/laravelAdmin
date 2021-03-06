<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = "menus";
    protected $fillable = ['name','group','description'];

    public function users()
    {
        return $this->belongsToMany("App\User","user_vs_menus", 'id_user', 'id_menu');
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
