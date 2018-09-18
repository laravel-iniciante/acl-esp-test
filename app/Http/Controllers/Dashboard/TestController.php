<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Easy\Form;
use App\User;

class TestController extends Controller
{
    public function index(Form $form){
    	// echo $form->text()->make();

        $user = User::findOrFail(2);

    	// echo $form->select()
     //        ->model($user)
     //        ->name('cidade')
     //        ->attr(['class'=>'form-control', 'placeholder' => 'Digite Aqui'])
     //        ->make();

        return view('teste.form', compact('user','form'));

    }

    public function save(Form $form){
        // echo $form->text()->make();

        $user = User::findOrFail(2);

        return view('teste.form', compact('user','form'));

    }

}
