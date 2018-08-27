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

    /** @author Thiago Sobrinho
     *   callInputScopes([
            name' => 'filter.nome', 
            'email' => 'filter.email', 
            'roles' => 'filter.role', 
            'status' => 'filter.status' 
        ])
     *
    */
    
    public function scopeCallInputScopes($query, $configs = []){

        foreach ($configs as $scopeMethodName => $requestKeyName) {

            $paramValue = \Request::input($requestKeyName);
            $paramValue = (String) $paramValue;

            if( $paramValue != ''){

                $scopeMethodName = explode('-', $scopeMethodName);
                $scopeMethodName = array_map("ucfirst", $scopeMethodName);
                $scopeMethodName = implode('', $scopeMethodName);
                $scopeMethodName = 'scope'.$scopeMethodName;

                $query = call_user_func( array( $this, $scopeMethodName), $query, $paramValue);
            }

        }

        return $query;

    }

    public function scopeApplyFilters($query, $filters)
    {

        foreach ($filters as $filter) {

            $field 		   = $filter['field'];
            $operator 	    = ( isset($filter['operator']) ) ? strtolower($filter['operator']) : '=' ;
            $paramName      = $filter['paramName'];
            $relation       = ( isset($filter['relation']) && !empty($filter['relation'])) ? $filter['relation'] : null ;
            $function  		= ( isset($filter['function']) && !empty($filter['function'])) ? $filter['function'] : 'orWhere' ;

            // $paramValue = \Request::input($paramName);
            $paramValue = \Request::input($paramName);;

			if( $paramValue ){

				if( strpos($operator, 'like') != false ){
					$paramValue = str_replace("like", $paramValue, strtolower($operator));
					$operator = 'LIKE';
				}

                $functions = [
                    'where'     => 'where',
                    'or'        => 'orWhere',

                    'date'      => 'whereDate',
                    'month'     => 'whereMonth',
                    'day'       => 'whereDay',
                    'year'      => 'whereYear',
                    'time'      => 'whereTime',

                    'in'        => 'whereIn',
                    'notin'     => 'whereNotIn',

                    'null'      => 'whereNull',
                    'notnull'   => 'whereNotNull',

                    //'between'     => 'whereBetween',
                    //'notbetween'  => 'whereNotBetween',
                ];

				if( !$relation ) {

		            $function = $functions[$function];

		            if( in_array($function, ['where', 'orWhere']) || in_array($function, ['whereDate', 'whereMonth', 'whereDay', 'whereYear', 'whereTime' ]) ){
						$query = $query->{$function}($field, $operator, $paramValue);
		            }else if( in_array($function, ['whereIn','whereNotIn'] )){
		            	$query = $query->{$function}($field, $paramValue);
		            }else if( in_array($function, ['whereNull','whereNotNull'] )){
						$query = $query->{$function}($field);
		            }

                }else{

                    $query = $query->orWhereHas($relation, function($query) use($field,$operator,$paramValue, $function){
                    if( in_array($function, ['where', 'orWhere']) || in_array($function, ['whereDate', 'whereMonth', 'whereDay', 'whereYear', 'whereTime' ]) ){
                        $query = $query->{$function}($field, $operator, $paramValue);
                    }else if( in_array($function, ['whereIn','whereNotIn'] )){
                        $query = $query->{$function}($field, $paramValue);
                    }else if( in_array($function, ['whereNull','whereNotNull'] )){
                        $query = $query->{$function}($field);
                    }                    });

	            }
	            //WHERE campo = 'valor' OR campo = 'valor'
			}


        }
        return $query;
    }


}
