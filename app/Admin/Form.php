<?php
 
namespace App\Admin;

class Form
{
    private $table = '';
	private $field = '';
    private $model = null;
 
    // this is a static method, it doesn't
    // run on an object, it only runs on a class
    public static function make()
    {
        // create an instance of class
        // QueryMaker and return it
        return new static();
    }
 
    public function model($model){
        $this->model = $model;
        return $this;
    }

    public function input( $config = []){
        $type = isset( $config['type'] ) ? $config['type'] : 'text';
        $name = isset( $config['name'] ) ? $config['name'] : 'name';
        $modelValue = $config['modelValue'];

        $errorClass = isValidClass($errors, $name);
        $value      = old($name, $this->model->{$modelValue});

        $html = '<input type="'.$type.'" class="form-control '. $errorClass .'" name="'.$name.'" value="'.$value.'">';
        // $html .= fieldErrorMessage($errors, $name);
        return $html;
    }
    
    public function flush()
    {
        return "select {$this->field} from {$this->table}";
    }

}
