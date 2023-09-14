@extends("main.index")

@section("body")
<div class="row d-flex justify-content-center mt-5">
    <h1 class="text-center">Register</h1>
    <div class="col-md-6">
        <form action="/register" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Name..." value="{{ old('name') }}">
                @error('name')
                <div class="col-auto">
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                </div>
                @enderror
            </div>
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
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" id="inputPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" aria-describedby="passwordHelpBlock">
                @error('password')
                <div class="col-auto">
                    <span class="text-danger">
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