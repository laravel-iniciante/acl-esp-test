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
        $this->label = 'llllllalallalalall';
        return $this->type('text')->makeTag('input')->getCompiledHtml();
        // echo $this->attrComp;
    }

}
