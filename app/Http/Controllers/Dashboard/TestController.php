<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Easy\Form;
use App\User;

class TestController extends Controller
{
    public function index(Form $form){
        $user = User::findOrFail(9);
        $checked = [5,2];
        return view('teste.form', compact('user','form','checked'));

    }

    public function save(Form $form, Request $request){

        $this->validate($request, [
            'name'      => 'required|email|',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|same:confirm-password',
            'status'    => 'required',
            'testecheck'=> 'required',
        ]);

        $user = User::findOrFail(9);
        $checked = [5,2];
        return view('teste.form', compact('user','form','checked'));

    }

    public function checkbox(){

        $users = [
            ['id' => 1, 'nome' => 'Pedro'],
            ['id' => 2, 'nome' => 'Thiago'],
            ['id' => 3, 'nome' => 'João'],
            ['id' => 4, 'nome' => 'Timóteo'],
            ['id' => 5, 'nome' => 'Matheus'],
        ];

        $default = [1,5];

        return view('teste.form-checkbox', compact('users','default'));
    }

    public function saveCheckbox(Request $request){

        $this->validate($request, [
            'users'=> 'required',
        ]);

        echo "Passei";
    }

}
