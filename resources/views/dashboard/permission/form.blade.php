
<div class="form-group">
    <label>Nome</label>
    <input class="form-control {{isValidClass($errors, 'name')}}" type="text" name="name" value="{{old('name', $permission->name)}}">
	@include('layouts.form.field-error-message', ['name' => 'name'])
</div>

<div class="form-group">
    <label>Label</label>
    <input class="form-control {{isValidClass($errors, 'label')}}" type="text" name="label" value="{{old('label', $permission->label)}}">

	@include('layouts.form.field-error-message', ['name' => 'label'])
</div>
