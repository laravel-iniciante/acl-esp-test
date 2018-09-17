<?php 

namespace App\Admin\Easy\Inputs;

class Select extends Input{

	protected  $val = ' 0 ';

	public function get(){
		$this->val .= ' 1 ';
		return $this;
	}

	public function options($options){
		$this->val .= $options;
		echo $this->val;
		return $this;
	}

	public function make(){

		echo 'fffffffffffff';

	}

}
