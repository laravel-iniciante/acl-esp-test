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

    protected $firstFieldError = null;

    protected $notShowValueProperty = ['select'];

    protected $options = [];

    protected $placeholder = null;

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
        $this->attr['type'] = $type;
        return $this;
    }

    protected function compileAtributes()
    {
        $attr = '';

        foreach ($this->attr as $attrKey => $attrValue) {
            $attr .= ' ' . $attrKey . '="'.$attrValue.'" ';
        }

        return $attr;
    }

    public function options($options, $value = null, $label = null )
    {
        $options = json_decode(json_encode($options));

        foreach ($options as $option) {
            $this->options[] = [
                $option->{$value},
                $option->{$label}
            ];
        }

        return $this;
    }

    protected function configErrors()
    {
        // pega os erros de validação
        $errors = \Request::session()->get('errors');

        // se existir erro no campo adiciona a class is-invalid
        if($errors){

            $name = $this->getName();

            if( $errors->has($name) ){

                if(isset($this->attr['class'])){
                    $this->attr['class'] .= ' is-invalid ';
                }

                $this->firstFieldError = $errors->first($name);
            }
        }

        return $this;
    }

    protected function errorMessage()
    {

        $html = '';

        if ($this->firstFieldError){
            $html .= '<span class="invalid-feedback d-block">';
            $html .= '    <strong>'. $this->firstFieldError .'</strong>';
            $html .= '</span>';
        }

        return $html;
    }


    protected function determinateModelField()
    {
        return ($this->modelColunm) ? $this->modelColunm : $this->name;
    }

    // ---------------------------------------------------
    // NAME
    // ---------------------------------------------------

    protected function attrName()
    {
        $this->attr['name'] =  $this->getName();
        return $this;
    }

    protected function getName()
    {
        return ($this->name) ? $this->name : $this->modelColunm;
    }

    // ---------------------------------------------------
    // VALUE
    // ---------------------------------------------------

    public function value($value){
        $this->attr['value'] = $value;
        return $this;
    }

    protected function getValue()
    {

        if($this->model){
            return  old($this->getName(), $this->model->{$this->determinateModelField()});
        }

        return false;
    }

    protected function attrValue()
    {
        $value = $this->getValue();
        if( $value ){
            $this->attr['value'] = $value;
        }

        return $this;
    }

    protected function isChecked()
    {

        if( isset($this->attr['value'])){
            if( $this->attr['value'] == old($this->getName())  ){
                $this->attr['checked'] = ' ckecked ';
            }
        }
        return $this;
    }


    // ---------------------------------------------------
    // TYPE
    // ---------------------------------------------------


    protected function makeTag($tag, $closeTag = true, $content = '')
    {

        $this->configErrors();

        $closeBar = ($closeTag) ? '' : '/';

        $html = '';
        $html .= '<';
        $html .= $tag;
        $html .= $this->compileAtributes();

        $html .= $closeBar;
        $html .= '>';

        $html .= $content;

        if($closeTag){
            $html .= '</';
            $html .= $tag;
            $html .= '>';
        }

        $html .= $this->errorMessage();

        $this->inputHtml = $html;
        return $this;
    }

    protected function selectOptions(){
        $html = '';

        if( $this->placeholder ){
            $html .= '<option>' . $this->placeholder .'<options>';
        }

        $value = $this->getValue();

        // dd( $value );

        foreach ( $this->options as $item) {

            $selected = '';
            if( $item[0] == $value){
                $selected = ' selected="selected" ';
            }

            $html .= '<option value="'.$item[0].'" '.$selected.'>';
            $html .= $item[1];
            $html .= '</option>';

        }

        return $html;
    }


    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function mergeHtml($compiled)
    {
        return str_replace("{{compiled}}", $compiled, $this->wrapHtml);
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
