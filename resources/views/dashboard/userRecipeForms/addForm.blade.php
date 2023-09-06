@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        <div class="alert alert-success alert-dismissible fade show success_message" style="display:none;" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Add Recipe</h1>
            <a href="/user-recipe" class="btn btn-secondary w-2.5">Add Recipe</a>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="recipeName" class="form-label">Recipe Name</label>
                <input type="text" class="form-control" id="recipeName" placeholder="Nasi Goreng">
            </div>
        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>
</div>
@endsection