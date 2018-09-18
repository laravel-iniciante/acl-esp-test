<?php

namespace App\Admin\Easy\Inputs;

class Input {

    protected $attr     = [];
    protected $attrComp = '';
    protected $name = null;
    protected $type = null;

    protected $model = null;
    protected $modelColunm = null;

    public function attr($attr = [])
    {
        $this->attr = $attr;
        return $this;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    protected function compileAttr()
    {
        $attr = '';

        foreach ($this->attr as $attrKey => $attrValue) {
            $attr .= ' ' . $attrKey . '="'.$attrValue.'" ';
        }

        return $attr;
    }


    protected function makeTag($tag, $closeTag = true, $content = ''){

        $closeBar = ($closeTag) ? '' : '/';

        $name = ($this->name) ? $this->name : $this->modelColunm;

        if($this->model){
            $field = ($this->modelColunm) ? $this->modelColunm : $this->name;
            $value = old($name, $this->model->id);
        }

        $name = ($this->name) ? $this->name : $this->modelColunm;



        $html = '';
        $html .= '<';
        $html .= $tag;
        $html .= $this->compileAttr();
        $html .= $closeBar;
        $html .= ($this->type) ? ' type="'. $this->type .'" ' : '';
        $html .= ' name="'. $name .'" ';
        $html .= (isset($value)) ? ' value="'. $value .'" ' : '';
        $html .= '>';

        $html .= $content;

        if($closeTag){
            $html .= '</';
            $html .= $tag;
            $html .= '>';
        }

        return $html;
    }

    public function model($model, $modelColunm = null){
        $this->model = $model;
        $this->modelColunm = $modelColunm;
        return $this;
    }

}
