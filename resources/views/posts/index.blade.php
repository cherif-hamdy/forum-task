@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>All Posts</strong>
                <a href="{{ route('posts.create') }}" class="btn btn-primary d-inline-flex float-right">Add Post</a>
            </div>
            <div class="card-body">
                @if($posts->count() == 0)
                    <p>No Posts Are Found</p>

                @else
                    @foreach($posts as $post)
                        <strong><a href="{{ route('posts.show' , $post->id) }}">{{ $post->title }}</a></strong>
                        <p class="text-muted">Posted By : {{ $post->author->name }}</p>
                        <p>{{ $post->content }}</p>
                        @auth()
                            @if(auth()->user()->id == $post->author->id)
                                <a href="{{ route('posts.edit' , $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy' , $post->id) }}" class="d-inline-flex"
                                      method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        @endauth
                        <hr>
                    @endforeach
                @endif
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection