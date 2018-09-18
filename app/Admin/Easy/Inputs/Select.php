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
		return $this;
	}

	public function make(){
		return $this->makeTag('select',true, '<option value="nome">lalalal</option><option value="nome">lalalal</option>');
		// echo $this->attrComp;
	}

}
