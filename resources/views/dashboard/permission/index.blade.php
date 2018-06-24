@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Permissões</h1>
	</div>

    <div class="table-responsive">
        <table class="table table-hover">
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
				 	<td>
				 		
						<a href="{{route('permission.edit',[$permission->id])}}" class="btn btn-sm btn-warning">
							<span data-feather="edit"></span>
						</a>
						
	                    <form class="delete" action="{{ route('permission.destroy', $permission->id) }}" method="POST">
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
    </div>

@endsection
