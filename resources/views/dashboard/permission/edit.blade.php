@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Editar Permissões</h1>
	</div>

	@include('layouts.form.form-errors-message')

	    <form method="POST" action="{{route('permission.update', ['permission' => $permission->id])}}">
	        {{csrf_field()}}
	        {{method_field('PUT')}}
	        @include('dashboard.permission.form')
	        <input type="submit" value="Atualizar" class="btn btn-default">
	    </form>

    </div>

@endsection
