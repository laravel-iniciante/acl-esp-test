@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('permission.index')}}">Permissões</a></li>
	<li class="breadcrumb-item active">	Detalhes</li>
@endsection

@section('content')

	<div class="card">
		<div class="card-header">
	    	<b>Papeis que utilizam a permissão</b> <i>{{$permission->label}}</i>
			<a href="{{route('permission.edit',[$permission->id])}}" class="float-right">
				<span data-feather="edit"></span> editar
			</a>
	  	</div>
		<ul class="list-group list-group-flush">
			@foreach($roles as $role)
				<li class="list-group-item">{{$role->label}}</li>
			@endforeach
	  	</ul>
	</div>

@endsection
