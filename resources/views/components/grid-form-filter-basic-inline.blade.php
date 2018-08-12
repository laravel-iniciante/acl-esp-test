<div class="d-inline-block">
    <form class="form-inline" action="{{url()->current()}}" method="GET">
		<div class="input-group input-group-sm">
			@if (isset($clean_url))
			<div class="input-group-prepend">
				<div class="input-group-text bg-light border-secondary">
					<a href="{{$clean_url}}">Limpar</a>
				</div>
			</div>
			@endif

			{{$slot}}

			<div class="input-group-append">
				<button type="submit" class="btn btn-secondary">
					<span data-feather="search"></span>
				</button>
			</div>
		</div>
    </form>
</div>