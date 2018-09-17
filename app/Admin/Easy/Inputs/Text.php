<?php 

namespace App\Admin\Easy\Inputs;

class Text extends Input{

	protected  $val = ' 0 ';

	public function get(){
		$this->val .= ' 1 ';
		return $this;
	}

	public function make(){
		$this->val .= ' 2 ';
		echo $this->val;
	}
}
