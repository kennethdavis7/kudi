@extends("main.index")

@section("body")
<div class="row d-flex flex-column align-items-center mt-5">
    <div class="col-md-6">
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="col-md-6">
        @if(session()->has("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <h1 class="text-center">Login</h1>
    <div class="col-md-6">
        <form action="/login" method="post">
            @csrf
            <div class="mb-3">
                <label for="emailAddress" class="form-label">Email address</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="emailAddress" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                @error('email')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="inputPassword5" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" aria-describedby="passwordHelpBlock">
                @error('password')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
        </form>
        <p>Haven't registered? <a href="/register">Register</a></p>
    </div>
</div>
@endsection