@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Role: <b>{{$role->name}}</b></h1>
	</div>

	<div class="card" style="width: 18rem;">
		<div class="card-header text-light bg-primary">
	    	<b>Permissões</b>
	  	</div>
		<ul class="list-group list-group-flush">
			@foreach($permissions as $permission)
				<li class="list-group-item">{{$permission->label}}</li>
			@endforeach
	  	</ul>
	</div>

@endsection
