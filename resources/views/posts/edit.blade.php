@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit {{ $post->title }}</div>
            <div class="card-body">
                <form action="{{ route('posts.update' , $post->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                        @if($errors->has("title"))
                            <div class="alert alert-danger">
                                {{ $errors->first("title") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content"  cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
                        @if($errors->has("content"))
                            <div class="alert alert-danger">
                                {{ $errors->first("content") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection