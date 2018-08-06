	<button type="submit" class="btn btn-sm {{ \Request::input('filter') ? 'btn-primary' : 'btn-outline-primary'}} js-btn-toggle-filter">
		Filtrar
		<span data-feather="filter"></span>
	</button>