<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Post;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Post::class => \App\Policies\PostPolicy::class,
        \App\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission) 
        {
            Gate::define($permission->name, function(User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        Gate::before(function ($user, $ability) {
            // return $user->hasAnyRoles('adm');

            if( $user->hasAnyRoles('adm') ){
                return true;
            }

            // if ($user->isSuperAdmin()) {
            //     return true;
            // }

        });

    }


}
