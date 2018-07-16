@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('role.index')}}">Papéis</a></li>
	<li class="breadcrumb-item active">	Detalhes</li>
@endsection

@section('content')

	<div class="card">
		<div class="card-header">
	    	<b>Permissões do Papel: <i>{{$role->name}}</i></b>
			<a href="{{route('role.edit',[$role->id])}}" class="float-right">
				<span data-feather="edit"></span> editar
			</a>
	  	</div>
		<ul class="list-group list-group-flush">
			@foreach($permissions as $permission)
				<li class="list-group-item">{{$permission->label}}</li>
			@endforeach
	  	</ul>
	</div>

@endsection



