@extends('dashboard.app')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Posts</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary">Share</button>
				<button class="btn btn-sm btn-outline-secondary">Export</button>
			</div>
			<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
				<span data-feather="calendar"></span>
				This week
			</button>
		</div>
	</div>

    <div class="table-responsive">
        <table class="table table-hover">
          	<thead>
				<tr>
					<th>#</th>
					<th>Título</th>
					<th>Autor</th>
					<th>ações</th>
				</tr>
          	</thead>
			<tbody>
				@foreach($posts as $post)
				<tr>
					<td>{{$post->id}}</td>
					<td>{{$post->title}}</td>
				 	<td>{{$post->user->name}}</td>
				 	<td>
				 		@can('view_post',$post)
						<a href="{{route('post.edit',[$post->id])}}" class="btn btn-sm btn-warning">
							<span data-feather="edit"></span>
						</a>
						@endcan
						<a href="{{route('post.edit',[$post->id])}}" class="btn btn-sm btn-danger">
							<span data-feather="trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
        </table>
    </div>

@endsection
