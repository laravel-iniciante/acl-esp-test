@extends('dashboard.app')



@section('content')

    @include('layouts.form.form-errors-message')
    <form method="POST" action="{{route('test_save')}}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">

            {{csrf_field()}}


			@foreach ($users as $user)

				@if( in_array($user['id'], old('users', $default)) )
					<input type="checkbox" name="users[]" value="{{$user['id']}}" checked="checked">
				@else
					<input type="checkbox" name="users[]" value="{{$user['id']}}">
				@endif 

			    {{$user['nome']}} <br>
			    
			@endforeach


            </div>
            <div class="card-footer text-right">
                <input type="submit" value="Alterar" class="btn btn-success">
            </div>
        </div>
     </form>
@endsection
