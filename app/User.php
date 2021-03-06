<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    public function username()
    {
        return 'user_name';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOneThrough("App\Models\Admin\Role","App\Models\Admin\UserRole", 'id_user', 'id','id','id_role');
    }
    public function menus()
    {
        return $this->belongsToMany("App\Models\Admin\Menu","user_vs_menus", 'id_user', 'id_menu');
    }

    public function permissions()
    {
        return $this->hasManyThrough('App\Models\Admin\RolePermission', 'App\Models\Admin\UserRole','id_user',"id_role","id","id_role");
    }
}
