@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Create a post</div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @if($errors->has("title"))
                            <div class="alert alert-danger">
                                {{ $errors->first("title") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content"  cols="5" rows="5" class="form-control">{{ old('content') }}</textarea>
                        @if($errors->has("content"))
                            <div class="alert alert-danger">
                                {{ $errors->first("content") }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection