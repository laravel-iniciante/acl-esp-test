
<div class="form-group">
    <label>Nome</label>
    <input class="form-control {{isValidClass($errors, 'name')}}" type="text" name="name" value="{{old('name', $role->name)}}">
	@include('layouts.form.field-error-message', ['name' => 'name'])
</div>

<div class="form-group">
    <label>Label</label>
    <input class="form-control {{isValidClass($errors, 'label')}}" type="text" name="label" value="{{old('label', $role->label)}}">
	@include('layouts.form.field-error-message', ['name' => 'label'])
</div>

<div class="form-group">

	@foreach($permissions as $permission)
	<div class="form-check">
		<label class="form-check-label">

			<input class="form-check-input" 
			type="checkbox" 
			name="permission[]" 
			value="{{$permission->id}}"
			{{in_array($permission->id, @old('permission',$selectedPermissions)  )? ' checked="checked" ':''}}
			>
			{{$permission->name}} 
		</label>
	</div>
	@endforeach
</div>