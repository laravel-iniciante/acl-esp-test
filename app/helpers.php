<?php
use Illuminate\Support\Facades\Input;

function isValidClass($errors, $field){
	return $errors->has($field) ? ' is-invalid' : '';
}

function link_sort($col) {

    $parameters = [
    	'order_by' => $col,
    	'order' => (Input::get('order') === 'asc' ? 'desc' : 'asc')
    ];

    return route(Route::currentRouteName(), $parameters);
}

function icon_sort($col) {

	$order = '<span data-feather="chevrons-up"></span>';

	if( Input::get('order_by') == $col ){
		$order = (Input::get('order') === 'asc' ? '<span data-feather="arrow-up"></span>' : '<span data-feather="arrow-down"></span>');
	}

    return $order;
}

function checkedFilter($needle, $input ){
    return in_array($needle, \Request::input($input,[])  ) ? ' checked="checked" ':'';
}


function boolenValue($value, $trueValue, $falseValue ){

    $value = (String) $value;

    if( $value === '1' ){
        return $trueValue;
    }
    if( $value === '0' ){
        return $falseValue;
    };
    return false;
}
