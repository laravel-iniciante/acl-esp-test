@extends('dashboard.app')



@section('content')

    @include('layouts.form.form-errors-message')
    <form method="POST" action="{{route('test_save')}}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">

            {{csrf_field()}}


            @php
            if($errors->all()){
                $values = old('users',[]);
            }else{
                $values = $default;
            }

            @endphp


			@foreach ($users as $user)

				@if( in_array($user['id'], $values ) )
					<input type="checkbox" name="users[]" value="{{$user['id']}}" checked="checked">
				@else
					<input type="checkbox" name="users[]" value="{{$user['id']}}">
				@endif

			    {{$user['nome']}} s<br>

			@endforeach


            </div>
            <div class="card-footer text-right">
                <input type="submit" value="Alterar" class="btn btn-success">
            </div>
        </div>
     </form>
@endsection
