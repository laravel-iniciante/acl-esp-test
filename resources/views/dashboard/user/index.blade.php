@extends('dashboard.app')

@section('content')


	<h1 class="h3 mt-2">Usuários</h1>

	<div class="card">

		<div class="card-header bg-transparent">

			<a class="btn btn-sm btn-primary float-right" href="{{route('user.create')}}">Adicionar usuário</a>

			@component('components.grid-batch-actions')

				@component('components.grid-form-delete', ['action' => route('user.destroy', '')])
				@endcomponent 

			@endcomponent

	    	@component('components.grid-btn-filter')
			    <a class="dropdown-item" href="{{url()->current()}}/?{!! urlencode ( 'filter[status]' ) !!}=1">Ativos</a>
			    <a class="dropdown-item" href="{{url()->current()}}/?{!! urlencode ( 'filter[status]' ) !!}=0">Inativos</a>
			@endcomponent

			@component('components.grid-form-filter-basic-inline',['clean_url' => route('user.index')])
				
				<input type="text" name="filter[email]" placeholder="Email" value="{{\Request::input('filter.email')}}" class="form-control border-secondary form-control-sm" />
				
				<input type="text" name="filter[nome]" placeholder="Nome" 	value="{{\Request::input('filter.nome')}}"  class="form-control border-secondary form-control-sm" />			
			@endcomponent


		</div><!-- /card -->



	    @component('components.grid-form-filter-full')

			<div class="row">
				<div class="col">
					<label>Email</label>
					<input type="text" name="filter[email]" placeholder="Email" value="{{\Request::input('filter.email')}}" class="form-control border-secondary form-control-sm" />
				</div>
				<div class="col">
					<label>Nome</label>
					<input type="text" name="filter[nome]" placeholder="Nome" value="{{\Request::input('filter.nome')}}"  class="form-control border-secondary form-control-sm" />
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
				<div class="col">
					<label>Status</label><br>
					<label><input type="radio" name="filter[status]" value="0" {!! boolenValue(\Request::input('filter.status'), '', 'checked' ) !!}/> Inativo</label> <br>
					<label><input type="radio" name="filter[status]" value="1" {!! boolenValue(\Request::input('filter.status'), 'checked', '' ) !!}/>Ativo</label>  <br>
				</div>
			</div>

		@endcomponent


<!-- <img src="{{url('storage/image/P3NwxoQkcbfmPJ4aDP6fDyCgkOghtWmrFVdgnlls.jpeg')}}" alt=""> : -->
	    <div class="table-responsive">
	        <table class="table table-hover table-bordered table-sm mb-0">
	          	<thead class="thead-light">
					<tr>
						<th width="30" class="text-center">
							<input type="checkbox" name="checkbox[]" id="js-check-all"  value="" />
						</th>
						<th width="50">ID</th>
						<th>
							<a href="{{ link_sort('name') }}"> Nome {!! icon_sort('name') !!} </a>
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
						<td class="text-center">{{$user->id}}</td>
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

		@component('components.grid-pagination', ['result' => $users])
		@endcomponent

	</div><!-- /card -->

@endsection
