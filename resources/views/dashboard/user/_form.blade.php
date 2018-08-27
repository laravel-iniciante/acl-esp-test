
@component('components.input-wrap-simple',['label' => 'Nome'])
    {!!inputText($user, $errors, [
        'name'       => 'name',
        'modelValue' => 'name'
    ])!!}
@endcomponent

@component('components.input-wrap-simple',['label' => 'Email','help'=>'Helpppp'])
    {!!inputEmail($user, $errors,[
        'name'       => 'email',
        'modelValue' => 'email'
    ])!!}
@endcomponent


{!! 
    optionList($user, $errors,[
        'name'          => 'sexo',
        'modelColunm'   => 'sexo', // opcional
        'defaultValue'   => 'f',   // opcional
        'listValueKeys' => ['label','value'], 
        'listValue'     => [
            ['label' => 'Masculino','value'=>'m'], 
            ['label' => 'Feminino','value'=>'f']
        ]
    ]) 

!!}

{!! 
    select($user, $errors,[
        'name'          => 'sexo',
        'modelColunm'   => 'sexo', // opcional
        'defaultValue'   => 'f',   // opcional
        'listValueKeys' => ['label','value'], 
        'listValue'     => [
            ['label' => 'Masculino','value'=>'m'], 
            ['label' => 'Feminino','value'=>'f']
        ]
    ]) 

!!}


<div class="form-group">
    <label>Senha</label>
    <input class="form-control {{isValidClass($errors, 'password')}}" type="text" name="password" value="{{old('password')}}">
	@include('layouts.form.field-error-message', ['name' => 'password'])
</div>

<div class="form-group">
    <label>Senha</label>
    <input class="form-control {{isValidClass($errors, 'confirm-password')}}" type="text" name="confirm-password" value="{{old('confirm-password')}}">
	@include('layouts.form.field-error-message', ['name' => 'confirm-password'])
</div>

<div class="form-group">
    <label>Imagem</label>
    <input type="file" name="file" class="form-control">
</div>


@component('components.input-wrap-simple',['label' => 'Papéis do usuário'])
   {!! checkboxList($roles, $errors,[
        'modelId'       => 'id',
        'modelLabel'    => 'label',
        'name'          => 'role[]',
        'listValue'     => $selectedRoles
   ]) !!}
@endcomponent


