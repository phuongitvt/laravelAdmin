<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = 'slugs';

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany('App\Models\Admin\Permission','id_slug', 'id');
    }
}
