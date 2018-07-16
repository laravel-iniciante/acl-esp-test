@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	Permissões</li>
@endsection

@section('content')

	<div class="card">

		<div class="card-header bg-transparent">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ">
				<b>Permissões</b>
				<a class="btn btn-sm btn-outline-primary pull-right" href="{{route('permission.create')}}">Novo</a>
			</div>
		</div>

	    <div class="table-responsive">
	        <table class="table table-striped table-sm">
	          	<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Permissão</th>
						<th>ações</th>
					</tr>
	          	</thead>
				<tbody>
					@foreach($permissions as $permission)
					<tr>
						<td>{{$permission->id}}</td>
					 	<td>
					 		<a href="{{route('permission.show',[$permission->id])}}">
					 		{{$permission->label}}
					 		</a>
					 	</td>
					 	<td>{{$permission->name}}</td>
					 	<td width="100">
					 		
							<a href="{{route('permission.edit',[$permission->id])}}" class="btn btn-sm btn-warning">
								<span data-feather="edit"></span>
							</a>
							
		                    <form class="delete" action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="display: inline">
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
