<div class="form-group">
    <label>Nome</label>
    <input class="form-control {{isValidClass($errors, 'name')}}" type="text" name="name" value="{{old('name', $user->name)}}">
	@include('layouts.form.field-error-message', ['name' => 'name'])
</div>


<div class="form-group">
    <label>Email</label>
    <input class="form-control {{isValidClass($errors, 'email')}}" type="text" name="email" value="{{old('email', $user->email)}}">
	@include('layouts.form.field-error-message', ['name' => 'email'])
</div>

<div class="form-group">
    <label>Papéis do usuário</label>
    @foreach($roles as $role)
    <div class="form-check">
        <label class="form-check-label">

            <input class="form-check-input"
            type="checkbox"
            name="role[]"
            value="{{$role->id}}"
            {{in_array($role->id, @old('role',$selectedRoles)  )? ' checked="checked" ':''}}
            >
            {{$role->label}}
        </label>
    </div>
    @endforeach
</div>

<div class="form-group">
    @foreach($generos as $genero)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sexo" value="{{$genero['value']}}"
        {{old('sexo', $user->sexo) == $genero['value'] ? ' checked="checked" ':''}}
        id="_{{$genero['value']}}"
        >
        <label class="form-check-label" for="_{{$genero['value']}}">{{$genero['label']}} </label>
    </div>
    @endforeach
</div>

<div class="form-group">
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="status" value="1" 
            {{old('status', $user->status) == 1 ? ' checked ' : ''}} >
            Ativo
        </label>
    </div>
</div>

<div class="form-group">
    <label>Imagem</label>
    <input type="file" name="file" class="form-control">
</div>

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