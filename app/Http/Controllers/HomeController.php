<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function debug()
    {
        $nome = auth()->user()->name;
        $roles = auth()->user()->roles;

        echo "<h1>{$nome}</h1>";
        foreach ($roles as $role) {
            echo $role->name . '<br>';

            $permissions = $role->permissions;

            foreach ($permissions as $permission) {
                echo '- ' . $permission->name . '<br>';
            }
             echo "<hr>";
        }
    }

}
