<form class="p-3 bg-light {{ \Request::input('filter') ? '' : 'hidden'}} js-box-filter" action="{{url()->current()}}" method="GET">
	<p class="h4 font-weight-bold border-bottom">Filtros</p>

	{{ $slot }}


	<div class="text-right">
		<a href="{{route('user.index')}}" class="btn bt-default">Limpar</a>
		<button type="submit" class="btn btn-success"> Filtrar <span data-feather="search"></span> </button>
	</div>

</form><!-- filter -->