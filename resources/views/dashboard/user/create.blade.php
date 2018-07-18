@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('user.index')}}">Usuários</a></li>
	<li class="breadcrumb-item active">	Adicionar usuário</li>
@endsection

@section('content')

	@include('layouts.form.form-errors-message')
	<form method="POST" action="{{route('user.store')}}">
		<div class="card">
			<div class="card-header bg-transparent"> <b>Novo usuário</b> </div>
			<div class="card-body">

			    {{csrf_field()}}
			    @include('dashboard.user.form')

			</div>
			<div class="card-footer text-right">
				<a class="btn btn-link" href="{{route('user.index')}}">cancelar</a>
				<input type="submit" value="Salvar" class="btn btn-success">
			</div>
	    </div>
	 </form>	
@endsection
