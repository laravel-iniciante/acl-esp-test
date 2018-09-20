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

}
