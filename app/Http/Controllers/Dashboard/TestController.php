<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Easy\Form;
use App\User;

class TestController extends Controller
{
    public function index(Form $form){
        $user = User::findOrFail(2);
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

        $user = User::findOrFail(2);
        $checked = [5,2];
        return view('teste.form', compact('user','form','checked'));

    }

}
