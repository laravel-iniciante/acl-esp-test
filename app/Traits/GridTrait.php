<?php

// http://hack.swic.name/laravel-column-sorting-made-easy/


namespace App\Traits;
use Illuminate\Support\Facades\Input;


trait GridTrait {

    // Autor Thiago Sobrinho
    public function scopeSortable($query, $default = []) {
        if(Input::has('order_by') && Input::has('order')){
            if(in_array(Input::get('order_by'), $this->sortable)){
                return $query->orderBy(Input::get('order_by'), Input::get('order'));
            }
            
        } else {

            if( $default ){
                return $query->orderBy($default[0], $default[1]);
            }

            return $query;
        }
    }

    // Autor Thiago Sobrinho
    public function scopeCallInputScopes($query, $configs = []){
        
        foreach ($configs as $scopeMethodName => $requestKeyName) {

            $paramValue = \Request::input($requestKeyName);

            if($paramValue){
                $scopeMethodName = explode('-', $scopeMethodName);
                $scopeMethodName = array_map("ucfirst", $scopeMethodName);
                $scopeMethodName = implode('', $scopeMethodName);
                $scopeMethodName = 'scope'.$scopeMethodName;

                $query = call_user_func( array( $this, $scopeMethodName), $query, $paramValue);                
            }
  
        }

        return $query;

    }
 
}