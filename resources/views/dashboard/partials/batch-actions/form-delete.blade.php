
    	<form class="js-form-delete d-inline-block" action="{{ $delete_url }}" method="POST">
	        <input type="hidden" name="_method" value="DELETE">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

	        <button type="submit" class="btn btn-sm btn-outline-danger ml-2 mr-2 mb-2 d-block js-send-form-delete">
				<span data-feather="trash"></span> Remover Selecionados
			</button>

	    </form>
