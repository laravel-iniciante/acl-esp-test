
<div class="btn-group">
	<button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Ações
	</button>
	<div class="dropdown-menu">
    	@include('dashboard.partials.batch-actions.form-delete',['delete_url' => $delete_url])
	</div>
</div>