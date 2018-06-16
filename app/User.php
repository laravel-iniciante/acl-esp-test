<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
       $this->belongToMany(\App\Role::class);
    }

    public function hasPermission($permission->roles)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if( $is_array($roles) || is_object($roles) ){
            foreach ($roles as $role) {
                return $this->roles->contain('name', $role->name);
            }
        }


        return $this->roles->contain('name', $roles);
    }


}
