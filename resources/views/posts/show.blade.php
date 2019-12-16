@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>{{ $post->title }}</strong>
            </div>
            <div class="card-body">
                {{ $post->content }}
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <strong>Comments</strong>
            </div>
            @if($comments->count() == 0)
                <div class="card-body">
                    <p>No Comments Are Found</p>
                </div>

            @else
                @foreach($comments as $comment)
                    <div class="card-body">
                        <strong>{{ $comment->owner->name }}</strong> : {{ $comment->body }}
                        <div>
                            @auth()
                                @if(auth()->user()->id == $comment->owner->id)
                                    <a href="{{ route('comments.edit' , [$post->id , $comment->id]) }}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('comments.destroy' , [$post->id , $comment->id]) }}"
                                          class="d-inline-flex" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            @endif

            {{ $comments->links() }}
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <strong>Add Comment</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('comments.store' , $post->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea cols="5" rows="5" class="form-control" name="body">{{ old('body') }}</textarea>
                        @if($errors->has("body"))
                            <div class="alert alert-danger">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection