<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Easy\Form;

class TestController extends Controller
{
    public function index(Form $form){
    	echo $form->text()->make();

    	echo $form->select()->options('opções')->make();
    }
}
