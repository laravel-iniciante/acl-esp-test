<?php

namespace App\Admin\Easy\Inputs;

class Radio extends Input{

    private $arrayRadioProp = [];
    private $classInline = '';

    public function get($name = null){

        if( $name ){
            $this->name = $name;
        }

        return $this;
    }

	public function make(){
        return $this->makeArrayCompile()->makeHtml();
	}

    public function makeArray(){
        $this->makeArrayCompile();
        return $arrayRadioProp;
    }

    protected function makeHtml(){
        $html = '';
        foreach ($this->arrayRadioProp as $radio) {
            $html .= $this->makeRadioInput($radio);

        }
        return $html;
    }

    public function inline(){
        $this->classInline = 'form-check-inline';
        return $this;
    }

    // --------------------------------------------------

    protected function makeArrayCompile(){
        $html = '';

        $value = $this->getValue();
        $name = $this->getName();

        foreach ( $this->options as $item) {

            $checked = '';
            if( $item[0] == $value){
                $checked = ' checked="checked" ';
            }

            $this->arrayRadioProp[] = [
                'name'      => $name,
                'label'     => $item[1],
                'value'     => $item[0],
                'checked'   => $checked,
            ];
        }
        return $this;
    }

    public function makeRadioInput($radio){
        $id = md5(uniqid(rand(), true));
        $html = '';
        $html .= '<div class="form-check '.$this->classInline.'">';
        $html .= '    <input type="radio" name="'.$radio['name'].'" value="'.$radio['value'].'" '.$radio['checked'].' id="'.$id.'"> ';
        $html .= '    <label class="form-check-label" for="'. $id .'"> ';
        $html .= $radio['label'];
        $html .= '    </label>';
        $html .= '</div>';
        return $html;
    }


}
