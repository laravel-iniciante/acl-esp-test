@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">Papéis</li>
@endsection

@section('content')

	<div class="card">

		<div class="card-header bg-transparent">

			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ">
				<b>Papéis</b>
				<a class="btn btn-sm btn-outline-primary pull-right" href="{{route('role.create')}}">Novo</a>
			</div>
		</div>
	    <div class="table-responsive">
	        <table class="table table-striped table-sm">
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
					 	<td width="100">
							<a href="{{route('role.edit',[$role->id])}}" class="btn btn-sm btn-warning">
								<span data-feather="edit"></span>
							</a>

		                    <form class="delete" action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: inline">
		                        <input type="hidden" name="_method" value="DELETE">
		                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
		                      
		                        <button type="submit" class="btn btn-sm btn-danger">
									<span data-feather="trash"></span>
								</button>
		                    </form>

						</td>
					</tr>
					@endforeach
				</tbody>
	        </table>
	    </div><!-- /table responsive -->		
	</div><!-- /card -->		
		

@endsection
