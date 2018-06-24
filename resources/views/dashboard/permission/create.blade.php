@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Permissões</h1>
	</div>

	@include('layouts.form.form-errors-message')

	    <form method="POST" action="{{route('permission.store')}}">
	        {{csrf_field()}}
	        @include('dashboard.permission.form')
	        <input type="submit" value="Salvar" class="btn btn-default">
	    </form>

    </div>

@endsection
