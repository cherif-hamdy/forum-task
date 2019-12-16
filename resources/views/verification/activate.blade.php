@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Activate Your Account
            </div>
            <div class="card-body">
                <form action="{{ route('verification') }}" method="post">
                    @csrf
                    <input type="hidden" name="real_code" value="{{ $code }}">
                    <div class="form-group">
                        <label for="code">Your Code</label>
                        <input type="text" name="code" class="form-control">
                        @if($errors->has('code'))
                            <div class="alert alert-danger">
                                {{ $errors->first('code') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection