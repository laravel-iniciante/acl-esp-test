<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permission;
use App\Role;
use App\User;
use App\Post;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();

        echo 'Usuários:' . $totalUsers . '<br>';
        echo 'Posts:' . $totalPosts . '<br>';
        echo 'Roles:' . $totalRoles . '<br>';
        echo 'Permissions:' . $totalPermissions . '<br>';

    }

}
