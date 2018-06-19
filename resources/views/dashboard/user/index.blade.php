@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Usuários</h1>
	</div>

    <div class="table-responsive">
        <table class="table table-hover">
          	<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Email</th>
					<th>ações</th>
				</tr>
          	</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
				 	<td>{{$user->email}}</td>
				 	
				 	<td>
				 		
						<a href="{{route('user.edit',[$user->id])}}" class="btn btn-sm btn-warning">
							<span data-feather="edit"></span>
						</a>
						
						<a href="{{route('user.edit',[$user->id])}}" class="btn btn-sm btn-danger">
							<span data-feather="trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
        </table>
    </div>

@endsection
