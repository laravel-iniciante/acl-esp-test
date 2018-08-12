<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\GridTrait;



class User extends Authenticatable
{
    use Notifiable;
    use GridTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Database columns that can be ordered by sortable method
     *
     * @var array
     */
    protected $sortable = ['name','email'];


    public function roles()
    {
       return $this->belongsToMany(\App\Role::class);
    }

    public function hasPermission($permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if( is_array($roles) || is_object($roles) ){
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }



    // -------------------------------
    // scopes for filter
    // -------------------------------

    public function scopeName($query, $q)
    {
        return $query->where('users.name', 'like', '%' .$q . '%');
    }

    public function scopeEmail($query, $q)
    {
        return $query->where('users.email', 'like',  '%' . $q . '%');
    }

    public function scopeRoles($query, $q)
    {
        return $query->whereIn('role_user.role_id', $q);
    }

    public function scopeStatus($query, $q)
    {
        return $query->where('users.status', '=', $q);
        //return $query;
    }

}
