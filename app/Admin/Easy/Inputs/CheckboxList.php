<?php

namespace App\Admin\Easy\Inputs;

class CheckboxList extends Input{

    private $arrayCheckboxProp = [];
    private $checkedValues = [];
    private $classInline = '';

    public function get($name = null)
    {

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

	public function make()
    {
        $this->makeArrayCompile();
        $this->configErrors();
        $this->makeHtml();

        // dd($this->arrayCheckboxProp);

        return $this->makeHtml();
	}

    public function makeArray()
    {
        $this->makeArrayCompile();
        return $arrayCheckboxProp;
    }

    protected function makeHtml()
    {
        $html = '';
        foreach ($this->arrayCheckboxProp as $radio) {
            $html .= $this->makeCheckboxInput($radio);

        }
        $html .= $this->errorMessage() ;
        return $html;
    }

    public function inline()
    {
        $this->classInline = 'form-check-inline';
        return $this;
    }

    public function checkedValues($values = [])
    {
        $this->checkedValues = $values;
        return $this;
    }


    // --------------------------------------------------

    protected function makeArrayCompile()
    {
        $html = '';

        $name = $this->getName();
        $this->configErrors();

        if($this->hasError()){
            $values = old($name);
        }else{
            $values = \Request::input($name);

            // dd(\Request::all());
            // dd(\Request::input());

            // dd( $values );
            // dd(old($name));
            if( ! $values ){
                $values = $this->checkedValues;
            }else{

            }
  
        }

        // dd(old($name), $this->checkedValues);

        if( $values == null ){
            $value = [];
        }

        foreach ( $this->options as $item) {

            $checked = '';

            if( $values && in_array($item[0], $values) ){
                $checked = ' checked="checked" ';
            }

            $this->arrayCheckboxProp[] = [
                'name'      => $name,
                'label'     => $item[1],
                'value'     => $item[0],
                'checked'   => $checked,
            ];


        }
        return $this;
    }

    public function makeCheckboxInput($checkbox)
    {
        $id = md5(uniqid(rand(), true));
        $html = '';
        $html .= '<div class="form-check '.$this->classInline.'">';
        $html .= '    <input type="checkbox" name="'.$checkbox['name'].'[]" value="'.$checkbox['value'].'" '.$checkbox['checked'].' id="'.$id.'"> ';
        $html .= '    <label class="form-check-label" for="'. $id .'"> ';
        $html .= $checkbox['label'];
        $html .= '    </label>';
        $html .= '</div>';
        return $html;
    }

}
