<?php 

namespace App\Admin\Easy;

class Builder 
{
	public function call($method)
	{
		$class = 'App\Admin\Easy\Inputs\\'.ucfirst($method);
		return call_user_func_array([new $class, 'get'], []);
	}

}

