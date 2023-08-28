@extends("main.index")

@section("body")
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6">
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <h1 class="text-center">Register</h1>
    <div class="col-md-6">
        <form action="/register" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value={{ old('name') }}>
                @error('name')
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="emailAddress" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="name@example.com" value={{ old('email') }}>
                @error('email')
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="inputPassword5" class="form-control" name="password" aria-describedby="passwordHelpBlock">
                @error('password')
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Register</button>
            </div>
        </form>
        <p>Already registered? <a href="/login">Login</a></p>
    </div>
</div>
@endsection