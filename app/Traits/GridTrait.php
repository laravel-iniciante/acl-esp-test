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

// ->where('votes', '>', 100)
// ->orWhere('name', 'John')

// ->whereBetween('votes', [1, 100])->get();
// ->whereNotBetween('votes', [1, 100])

// ->whereIn('id', [1, 2, 3])
// ->whereNotIn('id', [1, 2, 3])

// ->whereNull('updated_at')
// ->whereNotNull('updated_at')

// ->whereDate('created_at', '2016-12-31')
// ->whereMonth('created_at', '12')
// ->whereDay('created_at', '31')
// ->whereYear('created_at', '2016')
// ->whereTime('created_at', '=', '11:20:45')

// ->whereColumn('first_name', 'last_name') uma coluna é igual a outra



			if( $paramValue ){

				if( strpos($operator, 'like') >= 0 ){
					// Fornece: <body text='black'>
					$paramValue = str_replace("like", $paramValue, strtolower($operator));
					$operator = 'LIKE';
				}

				if( !$relation ) {

		            $functions = [
		            	'where' 	=> 'where',
		            	'or' 		=> 'orWhere',

		            	'date' 		=> 'whereDate',
		            	'month' 	=> 'whereMonth',
		            	'day' 		=> 'whereDay',
		            	'year' 		=> 'whereYear',
		            	'time' 		=> 'whereTime',

		            	'in' 		=> 'whereIn',
		            	'notin' 	=> 'whereNotIn',

		            	'null' 		=> 'whereNull',
		            	'notnull' 	=> 'whereNotNull',

						//'between' 	=> 'whereBetween',
		            	//'notbetween'	=> 'whereNotBetween',
		            ];

		            $function = $functions[$function];

		            if( in_array($function, ['where', 'orWhere']) || in_array($function, ['whereDate', 'whereMonth', 'whereDay', 'whereYear', 'whereTime' ]) ){
						
						$query = $query->{$function}($field, $operator, $paramValue);
		            
		            }else if( in_array($function, ['whereIn','whereNotIn'] )){
		            	
		            	$query = $query->{$function}($field, $paramValue);
		            
		            }else if( in_array($function, ['null','notnull'] )){
						
						$query = $query->{$function}($field);

		            }

                }else{

	               list($relation,$field) = explode('.',$field);

	               $query = $query->orWhereHas($relation, function($query) use($field,$operator,$paramValue){
	                  $query->where($field,$operator,$paramValue);
	               });

	            }
	            //WHERE campo = 'valor' OR campo = 'valor'
			}


        }
        return $query;
    }


}
