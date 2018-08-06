@extends('dashboard.app')

@section('content')

	<h1 class="h3 mt-2">Usuários</h1>

	<div class="card">

		<div class="card-header bg-transparent">

			<a class="btn btn-sm btn-primary float-right" href="{{route('user.create')}}">Adicionar usuário</a>

	    	@include('dashboard.partials.batch-actions.dd-menu',['delete_url' => route('user.destroy', '')])
	    	@include('dashboard.partials.btn-grid-filter')

			<div class="d-inline-block">
			    <form class="form-inline" action="{{url()->current()}}" method="GET">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<div class="input-group-text bg-light border-secondary">
								<a href="{{route('user.index')}}">Limpar</a>
							</div>
						</div>
						<input type="text" name="filter[email]" placeholder="Email" value="{{\Request::input('filter.email')}}" class="form-control border-secondary form-control-sm" />
						<input type="text" name="filter[nome]" placeholder="Nome" 	value="{{\Request::input('filter.nome')}}"  class="form-control border-secondary form-control-sm" />

						<div class="input-group-append">
							<button type="submit" class="btn btn-secondary">
								<span data-feather="search"></span>
							</button>
						</div>
					</div>
			    </form>
			</div>

		</div>


		<form class="p-3 bg-light {{ \Request::input('filter') ? '' : 'hidden'}} js-box-filter" action="{{url()->current()}}" method="GET">
			<p class="h4 font-weight-bold border-bottom">Filtros</p>

			<div class="row">
				<div class="col">
					<label>Email</label>
					<input type="text" name="filter[email]" placeholder="Email" value="{{\Request::input('filter.email')}}" class="form-control border-secondary form-control-sm" />
				</div>
				<div class="col">
					<label>Nome</label>
					<input type="text" name="filter[nome]" placeholder="Nome" 	value="{{\Request::input('filter.nome')}}"  class="form-control border-secondary form-control-sm" />
				</div>
				<div class="col">
					<div class="form-group">
					    <label>Papéis do usuário</label>
					    @foreach($roles as $role)
					    <div class="form-check">
					        <label class="form-check-label">

					            <input class="form-check-input"
					            type="checkbox"
					            name="filter[role][]"
					            value="{{$role->id}}"
					            {{!! checkedFilter($role->id, 'filter.role' ) !!}}
					            >
					            {{$role->label}}
					        </label>
					    </div>
					    @endforeach
					</div>
				</div>
			</div>

			<div class="text-right">
				<a href="{{route('user.index')}}" class="btn bt-default">Limpar</a>
				<button type="submit" class="btn btn-success"> Filtrar <span data-feather="search"></span> </button>
			</div>

		</form><!-- filter -->



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
						<th>Status </th>
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
							<button class="btn btn-sm btn-{{ boolenValue($user->status, 'success', 'default' ) }}">
								{{ boolenValue($user->status, 'Ativo', 'Inativo' ) }}
							</button>
						</td>

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

		@include('dashboard.partials.pagination', ['result' => $users])

	</div><!-- /card -->

@endsection
