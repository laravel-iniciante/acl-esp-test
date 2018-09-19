<?php

namespace App\Admin\Easy\Inputs;

class Input {

    protected $attr     = [];
    protected $attrComp = '';
    protected $name = null;
    protected $type = null;

    protected $model = null;
    protected $modelColunm = null;

    protected $wrapHtml  = '{{compiled}}';
    protected $inputHtml = '';

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
            $value = old($name, $this->model->{$field});
        }

        // pega os erros de validação
        $errors = \Request::session()->get('errors');

        // se existir erro no campo adiciona a class is-invalid
        if($errors){
            if( $errors->has($name) ){
                if(isset($this->attr['class'])){
                    $this->attr['class'] .= ' is-invalid ';
                }
            }
        }

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

        if($errors){
            if ($errors->has($name)){
                $html .= '<span class="invalid-feedback">';
                $html .= '    <strong>'. $errors->first($name) .'</strong>';
                $html .= '</span>';
            }
        }

        $this->inputHtml = $html;
        return $this;
    }

    public function mergeHtml($compiled)
    {

        return str_replace("{{compiled}}", $compiled, $this->wrapHtml);
        // return $this->wrapHtml;

    }

    public function getCompiledHtml(){
        return $this->mergeHtml($this->inputHtml);
    }



    public function model($model, $modelColunm = null){
        $this->model = $model;
        $this->modelColunm = $modelColunm;
        return $this;
    }

    public function wrapSimple($label = null)
    {

        $html = '';
        $html .= '<div class="form-group">';

        if($label){
            $html .= '<label>'. $label .'</label>';
        }

        $html .= '{{compiled}}';
        $html .= '</div>';

        $this->wrapHtml = $html;

        return $this;

    }

    public function wrapCol($label = null, $colCLassLeft = 'col-sm-2', $colClassRight = 'col-sm-10')
    {
        $html = '';
        $html .= '<div class="form-group row">';

        if($label){
            $html .= '<label class="'. $colCLassLeft .' col-form-label">'.$label.'</label>';
        }else{
            $html .= '<label class="'. $colCLassLeft .' col-form-label"></label>';
        }

        $html .= '    <div class="'. $colClassRight .'">';
        $html .= '{{compiled}}';
        $html .= '    </div>';
        $html .= '</div>';

        $this->wrapHtml = $html;

        return $this;
    }

}
