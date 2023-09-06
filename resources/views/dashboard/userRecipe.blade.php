@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        <div class="alert alert-success alert-dismissible fade show success_message" style="display:none;" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Your Recipes</h1>
            <div class="rounded bg-budget text-light px-3 py-2"><span id="percentage-budget"></span>% of budget used up</div>
        </div>
        <hr class="mb-5">
        <div class="col-md-4 mb-0">
            <div class="d-flex" role="search">
                <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 text-end">
            <a href="/user-recipe/create" class="btn btn-secondary add modal-open-btn">Add Recipe</a>
        </div>
        <div class="col-md-12">
            <table class="table w-full mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="tbody" id="ingredients-table">
                    <?php $i = 1; ?>
                    @foreach($recipes as $recipe)
                    <tr>
                        <th scope="col">{{$i}}</td>
                        <td scope="col"><img src="{{$recipe->recipe_img}}" width="200px" class="shadow-sm rounded"></td>
                        <td scope="col">{{$recipe->recipe_name}}</td>
                        <td scope="col">
                            <a href="#" class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-pencil-square"></i></a>
                            <a href="#" class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-trash"></i></a>
                            <a href="#" class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-eye"></i> </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection