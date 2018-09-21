<?php

namespace App\Admin\Easy\Inputs;

class Text extends Input{

    public function get($name = null){

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

    public function make(){

        return $this->type('text')
                    ->attrName()
                    ->attrValue()
                    ->makeTag('input')
                    ->getCompiledHtml();

    }

}
