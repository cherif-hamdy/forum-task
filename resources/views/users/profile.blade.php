@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img class="rounded-circle" src="/storage/images/{{ $user->image }}" style="height: 100px; width: 100px;"/>
                    <!-- badge -->
                    <div class="rank-label-container text-center">
                        <span class="label label-default rank-label">{{$user->name}}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <form action="{{ route('profile_image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                    <input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection