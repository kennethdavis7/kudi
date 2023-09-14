@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Profile</h1>
        </div>
        <hr class="mb-5">
        <form method="POST" action="/profile/{{auth()->user()->id}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <img src="{{asset('storage/' . auth()->user()->image)}}" alt="..." width="200px" class="img-thumbnail d-block mb-4">
                <label for="formFile" class="form-label">Profile photo</label>
                <input class="form-control {{$errors->has('image') ? 'is-invalid' : ''}}" type="file" name="image" id="formFile">
                @error('image')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="inputName">Username</label>
                <input type="username" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{auth()->user()->name}}" id="inputName">
                @error('name')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="inputEmail">Email address</label>
                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{auth()->user()->email}}" id="inputEmail">
                @error('email')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" id="inputPassword" placeholder="New password...">
                @error('password')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-secondary mb-5">Edit</button>
        </form>
    </div>
</div>
@endsection