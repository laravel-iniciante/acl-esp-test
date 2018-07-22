<?php

// http://hack.swic.name/laravel-column-sorting-made-easy/


namespace App\Traits;
use Illuminate\Support\Facades\Input;


trait SortableTrait {

    public function scopeSortable($query, $default = []) {
        if(Input::has('order_by') && Input::has('order')){
            return $query->orderBy(Input::get('order_by'), Input::get('order'));
        } else {

            if( $default ){
                return $query->orderBy($default[0], $default[1]);
            }

            return $query;
        }
    }
 
}