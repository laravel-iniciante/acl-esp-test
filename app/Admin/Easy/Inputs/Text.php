<?php

namespace App\Admin\Easy\Inputs;

class Text extends Input{

    protected  $val = ' 0 ';

    public function get($name = null){

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

    public function make(){
        return $this->type('text')->makeTag('input');
        // echo $this->attrComp;
    }

}
