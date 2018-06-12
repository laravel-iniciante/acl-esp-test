@extends('layouts.app')

@section('content')
<div class="container">
	
	<h2>{{$post->title}}</h2>
	<p>{{$post->description}}</p>
	<b>Autor: {{$post->user->name}}</b> <br>
	<a href="{{route('post.edit',[$post->id])}}">Editar</a>
	<hr>

	<p>Nenhum post cadastrado</p>

</div>
@endsection
