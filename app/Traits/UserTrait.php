<?php


namespace App\Traits;
use Illuminate\Support\Facades\Input;

trait UserTrait {

    public function scopeName($query, $name) {
        return $query;
    }

    public function scopeFilter($query) {
        return $query;
    }
 
}