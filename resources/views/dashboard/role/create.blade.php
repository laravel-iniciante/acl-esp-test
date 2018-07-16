@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	<a href="{{route('role.index')}}">Papéis</a></li>
	<li class="breadcrumb-item active">	Adicionar papel</li>
@endsection

@section('content')

	@include('layouts.form.form-errors-message')

    <form method="POST" action="{{route('role.store')}}">

		<div class="card">
			<div class="card-header bg-transparent"> <b>Novo papel</b> </div>
			<div class="card-body">

			   	{{csrf_field()}}
        		@include('dashboard.role.form')

			</div>
			<div class="card-footer text-right">
				<a value="Salvar" class="btn btn-link" href="{{route('role.index')}}">cancelar</a>
				<input type="submit" value="Salvar" class="btn btn-success">
			</div>
	    </div>

    </form>



@endsection





