<?php


function input($model, $errors, $config = []){
	$type = isset( $config['type'] ) ? $config['type'] : 'text';
	$name = isset( $config['name'] ) ? $config['name'] : 'name';
	$modelValue = $config['modelValue'];

	$errorClass = isValidClass($errors, $name);
	$value 		= old($name, $model->{$modelValue});

    $html = '<input type="'.$type.'" class="form-control '. $errorClass .'" name="'.$name.'" value="'.$value.'">';
	$html .= fieldErrorMessage($errors, $name);
	return $html;
}

function inputText($model, $errors, $config = []){
	$config['type'] = 'text';
	return input($model, $errors, $config);
}

function inputEmail($model, $errors, $config = []){
	$config['type'] = 'email';
	return input($model, $errors, $config);
}


function inputPassword($model, $field, $errors, $config = []){
	$config['type'] = 'password';
	return inputText($model, $field, $errors, $config);
}

function fieldErrorMessage($errors, $name){
	$html = '';
	if ($errors->has($name)) {
        $html .= '<span class="invalid-feedback">';
        $html .=     '<strong>'. $errors->first($name) .'</strong>';
        $html .= '</span>'	;
	}
	return $html;
}

function InputBoolean($model, $errors, $config = []){

	$name 		= isset( $config['name'] ) ? $config['name'] : 'name';
	$label 		= $config['name'];
	$modelValue = isset( $config['modelValue'] ) ? $config['modelValue'] : $config['name'];
	$value 		= old($name, $model->{$modelValue});

    $value = (String) $value;

    $checked = '';

    if( $value === '1' ){
        $checked = ' checked="checked" ';
    }

    $html ='<div class="form-check">';
    $html .='    <label class="form-check-label">';
    $html .='        <input class="form-check-input"';
    $html .='        type="checkbox"';
    $html .='        name="'.$name.'"';
    $html .='        value="1"';
    $html .= 		$checked;
    $html .='        >';
    $html .=       $label;
    $html .='    </label>';
    $html .='</div>';

    return $html;
}


function optionList( $model, $errors, $config = []){

	$name 			= isset( $config['name'] ) ? $config['name'] : 'name';
	$modelColunm 	= isset( $config['modelColunm'] ) ? $config['modelColunm'] : $name;
	$defaultValue 	= isset( $config['defaultValue'] ) ? $config['defaultValue'] : null;

	$listValues 	= isset( $config['listValue'] ) ? $config['listValue'] : [];
	$listValueKeys = $config['listValueKeys'];

	$listValues = json_decode(json_encode($listValues));

	$value = old($name, $model->{$modelColunm});

	if(! $value && $defaultValue){
		$value = $defaultValue;
	}

	$html = '';
	foreach ( $listValues as $item) {

		$ckecked = '';

		if( $item->{$listValueKeys[1]} == $value){
			$ckecked = ' checked="checked" ';
		}

		$html .= '<div class="form-check">';
		$html .= '	<input class="form-check-input" type="radio" name="'.$name.'" value="'.$item->{$listValueKeys[1]}.'" '.$ckecked.'>';
		$html .= '	<label class="form-check-label" >';
		$html .= $item->{$listValueKeys[0]};
		$html .= '	</label>';
		$html .= '</div>';

    };

    return $html;
}


function checkboxList( $model, $errors, $config = []){

	$modelId 	= isset( $config['modelId'] ) ? $config['modelId'] : 'id';
	$modelLabel = isset( $config['modelLabel'] ) ? $config['modelLabel'] : 'name';

	$listValues = isset( $config['listValue'] ) ? $config['listValue'] : [];
	$name 		= isset( $config['name'] ) ? $config['name'] : 'name';

	$html = '';
	foreach ( $model as $item) {
    $html .='<div class="form-check">';
    $html .='    <label class="form-check-label">';
    $html .='        <input class="form-check-input"';
    $html .='        type="checkbox"';
    $html .='        name="'.$config['name'].'"';
    $html .='        value="'.$item->{$modelId}.'"';
    $html .=         in_array($item->{$modelId}, old($name, $listValues) )? ' checked="checked" ' : '' ;
    $html .='        >';
    $html .=       $item->{$modelLabel};
    $html .='    </label>';
    $html .='</div>';
    };

    return $html;
}

function select( $model, $errors, $config = []){

	$name 			= isset( $config['name'] ) ? $config['name'] : 'name';
	$modelColunm 	= isset( $config['modelColunm'] ) ? $config['modelColunm'] : $name;
	$defaultValue 	= isset( $config['defaultValue'] ) ? $config['defaultValue'] : null;

	$listValues 	= isset( $config['listValue'] ) ? $config['listValue'] : [];
	$listValueKeys = $config['listValueKeys'];

	$listValues = json_decode(json_encode($listValues));

	$value = old($name, $model->{$modelColunm});

	if(! $value && $defaultValue){
		$value = $defaultValue;
	}


	$html = '<select name="'.$name.'" >';
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