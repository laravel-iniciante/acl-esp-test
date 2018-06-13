@extends('layouts.app')

@section('content')
<div class="container">

    @forelse($posts as $post)
		
		<h2>{{$post->title}}</h2>
		<p>{{$post->description}}</p>
		<b>Autor: {{$post->user->name}}</b> <br>
		@can('update',$post)
			<a href="{{route('post.edit',[$post->id])}}">Editar</a>
			<hr>
		@endcan
    	@empty

		<p>Nenhum post cadastrado</p>

    @endforelse

</div>
@endsection
