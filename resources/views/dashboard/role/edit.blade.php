@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('role.index')}}">Papéis</a></li>
	<li class="breadcrumb-item active">	Alterar papel</li>
@endsection

@section('content')

	@include('layouts.form.form-errors-message')

	<form method="POST" action="{{route('role.update', ['role' => $role->id])}}">
		<div class="card">
			<div class="card-header bg-transparent"> <b>Alterar papel</b> </div>
			<div class="card-body">
			    
	        {{csrf_field()}}
	        {{method_field('PUT')}}
	        @include('dashboard.role.form')
 	
			</div>
			<div class="card-footer text-right">
				<a class="btn btn-link" href="{{route('role.index')}}">cancelar</a>
				<input type="submit" value="Salvar" class="btn btn-success">
			</div>
	    </div>
	</form>	

@endsection
