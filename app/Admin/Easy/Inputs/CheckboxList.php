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


        $values = $this->checkedValues;

        print_r(old($name, $this->checkedValues));
        print_r(\Request::old($name, $this->checkedValues));

        // dd($values);

        // $a = \Request::old($name, $this->checkedValues);

        // dd($a);

        $has_error = null;
        $errors = \Request::session()->get('errors');
        if($errors){
            if( $errors->has($name) ){
                $has_error = old($name) == null ? [] : old($name);
            }
        }

        // $values = [];



        // in_array($item[0], old($name, $this->checkedValues) )? ' checked="checked" ' : '';


// http://localhost:8079/laravel-iniciante/acl-especializati/public/dashboard/test


        foreach ( $this->options as $item) {

            $checked = '';
            if( in_array($item[0], $values) ){
                $checked = ' checked="checked" ';
            }

            $checked = '';
            if(is_array(old($name))){
                if(in_array($item[0], old($name))){
                    $checked = ' checked="checked" ';
                }
            }else{
                if( in_array($item[0], $this->checkedValues) ){
                    $checked = ' checked="checked" ';
                }
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
