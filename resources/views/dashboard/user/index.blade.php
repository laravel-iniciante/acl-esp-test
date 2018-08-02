@extends('dashboard.app')

@section('content')

	<div class="row">
		<div class="col">
			<h1 class="h3 mt-2">Usuários</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary float-right  mt-3" href="{{route('user.create')}}">Adicionar usuário</a>
		</div>
	</div>

	<div class="mb-sm-2">
	    <form class="js-form-delete d-inline-block" action="{{ route('user.destroy', '') }}" method="POST">
	        <input type="hidden" name="_method" value="DELETE">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

	        <button type="submit" class="btn btn-sm btn-danger js-send-form-delete">
				<span data-feather="trash"></span>
			</button>
	    </form>

		<div class="d-inline-block">
		    <form class="form-inline" action="{{url()->current()}}" method="GET">
		        <input type="text" name="nome" placeholder="Nome" 	value="{{\Request::get('nome')}}" 	class="form-control form-control-sm mr-sm-2" />
		        <input type="text" name="email" placeholder="Email" value="{{\Request::get('email')}}" class="form-control form-control-sm mr-sm-2" />

				<a href="{{route('user.index')}}" class="btn btn-sm btn-default">Limpar</a>
		        <button type="submit" class="btn btn-sm btn-primary">Pesquisar</button> &nbsp;
		    </form>
		</div>

	</div>

	<div class="card">

	    <div class="table-responsive">
	        <table class="table table-hover table-bordered table-sm mb-0">
	          	<thead class="thead-light">
					<tr>
						<th width="30" class="text-center">
							<input type="checkbox" name="checkbox[]" id="js-check-all"  value="" />
						</th>
						<th width="50">ID</th>
						<th>
							<a href="{{ link_sort('name') }}">
								Nome {!! icon_sort('name') !!}
							</a>
						</th>
						<th>
							<a href="{{ link_sort('email') }}">
							Email
							{!! icon_sort('email') !!}
							</a>
						</th>
						<th>Permissões</th>
						<th width="100">ações</th>
					</tr>
	          	</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td class="text-center">
							<input class="js-delete-checkbox" type="checkbox" name="checkbox[]" value="{{$user->id}}" /> </td>
						<td>{{$user->id}}</td>
						<td>
					 		<a href="{{route('user.show',[$user->id])}}">{{$user->name}}</a>
						</td>
					 	<td>{{$user->email}}</td>
					 	<td>{{$user->perms}}</td>

					 	<td>

							<a href="{{route('user.edit',[$user->id])}}" class="btn btn-sm btn-warning">
								<span data-feather="edit"></span>
							</a>

							<a href="{{route('user.destroy',[$user->id])}}" class="btn btn-sm btn-danger js-delete-button">
								<span data-feather="trash"></span>
							</a>

						</td>
					</tr>
					@endforeach
				</tbody>
	        </table>

	    </div><!-- /table responsive -->

		@if ($users->total() > $users->perPage())
		    <div class="pagination-wrapper">
		        {{ $users->appends(\Request::except(['page']))->links() }}
		    </div>
		@endif

	</div><!-- /card -->

@endsection
