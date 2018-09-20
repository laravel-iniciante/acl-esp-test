<?php

namespace App\Admin\Easy\Inputs;

class Select extends Input{

    public function get($name = null){

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

	public function make(){
        $this->label = 'llllllalallalalall';
        return $this->makeTag('select')->getCompiledHtml();
	}

}
