@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Comment
            </div>
            <div class="card-body">
                <form action="{{ route('comments.update' , [$post->id , $comment->id]) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <input type="text" class="form-control" name="body" value="{{ $comment->body }}">
                        @if($errors->has("body"))
                            <div class="alert alert-danger">
                                {{ $errors->first("body") }}
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