@extends('dashboard.app')

@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
	<li class="breadcrumb-item active">	Usuários</li>
@endsection

@section('content')

	<div class="card mb-3">
		
		<div class="card-header">
			<b>Filtros de pesquisa</b>	
		</div>

		<div class="card-body">
			<form action="{{url()->current()}}" method="GET">

				<div class="row mb-3">

				    <div class="col">
				    	<label>Nome</label>
						<input type="text" class="form-control form-control-sm" name="nome" placeholder="Nome" value="{{\Request::get('nome')}}">
				    </div>

				    <div class="col">
				    	<label>E-mail</label>
						<input type="text" class="form-control form-control-sm" name="email" placeholder="Email" value="{{\Request::get('email')}}">
				    </div>

				</div>

				<div class="text-right">
					<a href="{{route('user.index')}}" class="btn btn-light">Limpar</a>
					<button class="btn btn-primary" type="submit">Pesquisar</button>						
				</div>

			</form>
		</div>
	</div>

    <form class="js-form-delete" action="{{ route('user.destroy', '') }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      
        <button type="submit" class="btn btn-sm btn-danger js-send-form-delete">
			<span data-feather="trash"></span>
		</button>
    </form>

	<div class="card">

		<div class="card-header bg-transparent">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ">
				<b>Usuários</b>
				<a class="btn btn-sm btn-outline-primary pull-right" href="{{route('user.create')}}">Novo</a>
			</div>
		</div>

	    <div class="table-responsive">
	        <table class="table table-striped table-bordered table-sm">
	          	<thead>
					<tr>
						<th>
							<input type="checkbox" name="checkbox[]" id="js-check-all"  value="" />
						</th>
						<th>ID</th>
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
						<th width="100">ações</th>
					</tr>
	          	</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>
							<input class="js-delete-checkbox" type="checkbox" name="checkbox[]" value="{{$user->id}}" /> </td>
						<td>{{$user->id}}</td>
						<td>
					 		<a href="{{route('user.show',[$user->id])}}">{{$user->name}}</a>
						</td>
					 	<td>{{$user->email}}</td>
					 	
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

			{{ $users->appends(\Request::except(['page']))->links() }}

	    </div><!-- /table responsive -->
	</div><!-- /card -->

@endsection
