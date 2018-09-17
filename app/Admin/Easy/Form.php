<?php
 
namespace App\Admin\Easy;

class Form
{

    public function builder($method)
    {
        $this->input = (new Builder)->call($method,[]);
        return $this->input;
    }

    public function __call($method, $params)
    {
        return $this->builder($method);
    }

    public  function make()
    {
        // create an instance of class
        // QueryMaker and return it
        return 'passei';
    }
 
   

}
