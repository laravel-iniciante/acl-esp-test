<?php

namespace App\Admin\Easy\Inputs;

class Checkbox extends Input{

    public function get($name = null){

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

	public function make(){
        $input =  $this->type('checkbox')
                        ->attrName()
                        ->attrValue()
                        ->isChecked()
                        ->makeTag('input', false)
                        ->getCompiledHtml();

        return $input;
	}

}
