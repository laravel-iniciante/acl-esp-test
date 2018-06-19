@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Roles</h1>
	</div>

    <div class="table-responsive">
        <table class="table table-hover">
          	<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Role</th>

					<th>ações</th>
				</tr>
          	</thead>
			<tbody>
				@foreach($roles as $role)
				<tr>
					<td>{{$role->id}}</td>
					<td>
						<a href="{{route('role.show',[$role->id])}}">{{$role->label}}</a>
					</td>
					<td>{{$role->name}}</td>
				 	<td>
						<a href="{{route('role.edit',[$role->id])}}" class="btn btn-sm btn-warning">
							<span data-feather="edit"></span>
						</a>
						<a href="{{route('role.edit',[$role->id])}}" class="btn btn-sm btn-danger">
							<span data-feather="trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
        </table>
    </div>

@endsection
