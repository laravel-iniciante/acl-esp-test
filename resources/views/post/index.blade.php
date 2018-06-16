@extends('layouts.app')

@section('content')
<div class="container">

    @forelse($posts as $post)
		@can('view_post',$post)
			<h2>{{$post->title}}</h2>
			<p>{{$post->description}}</p>
			<b>Autor: {{$post->user->name}}</b> <br>
			<a href="{{route('post.edit',[$post->id])}}">Editar</a>
		@endcan
			<hr>
    	@empty
			<p>Nenhum post cadastrado</p>
    @endforelse

</div>
@endsection
