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

    protected function options($options, $value, $label)
    {
        $options = json_decode($json_encode($options));

        foreach ($options as $option) {
            $this->options[] = [
                'value' => $option[$value],
                'label' => $option[$label],
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
            $html .= '<span class="invalid-feedback">';
            $html .= '    <strong>'. $this->firstFieldError .'</strong>';
            $html .= '</span>';
        }

        return $html;
    }

    protected function getName()
    {
        return ($this->name) ? $this->name : $this->modelColunm;
    }

    protected function determinateModelField()
    {
        return ($this->modelColunm) ? $this->modelColunm : $this->name;
    }

    protected function getValue()
    {
        if($this->model){
            return  old($this->getName(), $this->model->{$this->determinateModelField()});
        }

        return false;
    }

    protected function makeTag($tag, $closeTag = true, $content = '')
    {

        $this->configErrors();

        $closeBar = ($closeTag) ? '' : '/';

        $name = $this->getName();

        $value = $this->getValue();

        $html = '';
        $html .= '<';
        $html .= $tag;
        $html .= $this->compileAttr();
        $html .= $closeBar;
        $html .= ($this->type) ? ' type="'. $this->type .'" ' : '';
        $html .= ' name="'. $name .'" ';

        if(!in_array($tag, $this->notShowValueProperty)){
            $html .= $value ? ' value="'. $value .'" ' : '';
        }

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

    function select( $model, $errors, $config = []){

        $name           = isset( $config['name'] ) ? $config['name'] : 'name';
        $modelColunm    = isset( $config['modelColunm'] ) ? $config['modelColunm'] : $name;
        $defaultValue   = isset( $config['defaultValue'] ) ? $config['defaultValue'] : null;

        $listValues     = isset( $config['listValue'] ) ? $config['listValue'] : [];
        $listValueKeys = $config['listValueKeys'];

        $listValues = json_decode(json_encode($listValues));

        $value = old($name, $model->{$modelColunm});

        if(! $value && $defaultValue){
            $value = $defaultValue;
        }


        $html = '<select name="'.$name.'" class="form-control">';
        foreach ( $listValues as $item) {

            $selected = '';

            if( $item->{$listValueKeys[1]} == $value){
                $selected = ' selected="selected" ';
            }

            $html .= '<option value="'.$item->{$listValueKeys[1]}.'" '.$selected.'>';
            $html .= $item->{$listValueKeys[0]};
            $html .= '</option>';

        };
        $html .= '</select>';

        return $html;
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
