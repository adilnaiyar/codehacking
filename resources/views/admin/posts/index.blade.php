@extends('layouts.admin')


@section('content')

	<h1>Posts List</h1>

	@if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible flash">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('delete'))
        <div class="alert alert-danger alert-dismissible flash">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>{{ $message }}</p>
        </div>
    @endif

	<table class="table table-striped table-dark">
	    <thead class="bg-success text-white text-center">
	        <th>Id </th>
	        <th>Photo</th>
	        <th>Title</th>
	        <th>Owner</th>
	        <th>Category</th>
	        <!-- <th>Body</th> -->
	        <th>Created At</th>
	        <th>Updated At</th>
	        <th>Comment</th>
            <th>Action</th>
	    </thead>
        <tbody>

            @foreach($posts as $post)
            <tr>
            	<td> {{ $post->id }} </td>
                <td> <img src="{{$post->photo->file ?? asset('/images/blog001.jpg')}}" height="50" alt="photo" class="img-fluid img-thumbnails"> </td>
                <td> {{ $post->title}}</td>
                <td> {{ $post->user->name}} </td>
                <td> {{ $post->category->name ?? 'Uncategorised'}} </td>
                <!-- <td> {{ Illuminate\Support\Str::limit($post->body, 10)}}</td> -->
                <td> {{ $post->created_at->diffForHumans()}}</td>
                <td> {{ $post->updated_at->diffForHumans()}}</td>
                <td> <a href="{{route('comments.show', $post->id)}}" class="btn btn-sm btn-primary">View Comment</a> </td>
                <td> 
                	{!! Form::open(['method' => 'delete', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

                	<a href="{{route('home.post', $post->slug)}}" class="btn btn-sm btn-info">View Post</a>

                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-warning"> Edit </a>

                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
				
					{!! Form::close() !!}
			    </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
   	</table>

    {{$posts->render()}}

@endsection