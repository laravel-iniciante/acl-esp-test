@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('permission.index')}}">Permissões</a></li>
	<li class="breadcrumb-item active">	Alterar permissão</li>
@endsection

@section('content')

	@include('layouts.form.form-errors-message')

	<form method="POST" action="{{route('permission.update', ['permission' => $permission->id])}}">
		<div class="card">
			<div class="card-header bg-transparent"> <b>Alterar permissão</b> </div>
			<div class="card-body">
			    
		        {{csrf_field()}}
		        {{method_field('PUT')}}
		        @include('dashboard.permission.form')
 	
			</div>
			<div class="card-footer text-right">
				<a value="Salvar" class="btn btn-link" href="{{route('permission.index')}}">cancelar</a>
				<input type="submit" value="Salvar" class="btn btn-success">
			</div>
	    </div>
	</form>	



	





@endsection
