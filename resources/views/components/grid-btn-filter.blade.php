	
<div class="btn-group">

	<button type="submit" class="btn btn-sm {{ \Request::input('filter') ? 'btn-primary' : 'btn-outline-primary'}} js-btn-toggle-filter">
		Filtrar
		<span data-feather="filter"></span>
	</button>	

	@if(strlen($slot) > 0)
		<button type="button" class="btn btn-sm {{ \Request::input('filter') ? 'btn-primary' : 'btn-outline-primary'}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    		<span class="sr-only">Toggle Dropdown</span>
	  	</button>
		<div class="dropdown-menu dropdown-menu-right">
		{{$slot}}
		</div>
	@endif
	
</div>