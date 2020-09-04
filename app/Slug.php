<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = 'slugs';

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany('App\Permission','id_slug', 'id');
    }
}
