<?php

namespace App\Admin\Easy;

class Form
{

    public function builder($method, $params)
    {
        $this->input = (new Builder)->call($method, $params);
        return $this->input;
    }

    public function __call($method, $params)
    {

        return $this->builder($method, $params);
    }

    public  function make()
    {
        // create an instance of class
        // QueryMaker and return it
        return 'passei';
    }



}
