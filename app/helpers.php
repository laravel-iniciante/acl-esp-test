<?php 

function isValidClass($errors, $field){
	return $errors->has($field) ? ' is-invalid' : '';
}

