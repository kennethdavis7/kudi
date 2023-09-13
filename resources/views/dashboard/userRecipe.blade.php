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
            <a href="/user-recipes/create" class="btn btn-secondary add modal-open-btn">Add Recipe</a>
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
                        <th scope="col" class="align-middle">{{$i}}</td>
                        <td scope="col" class="align-middle"><img src="{{ asset('storage/' . $recipe->recipe_img) }}" width="200px" class="shadow-sm rounded"></td>
                        <td scope="col" class="align-middle">{{$recipe->recipe_name}}</td>
                        <td scope="col" class="align-middle">
                            <button class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-secondary" id="delete-recipe" data-id="{{$recipe->id}}" style="margin-right:1rem;"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-eye"></i> </button>
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

@section("script")
<script>
    $(document).ready(function() {
        $(document).on('click', '#delete-recipe', function(e) {

            const id = $(this).data("id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: `/user-recipes/${id}`,
                success: function(e) {
                    $(`#row-${id}`).remove();
                    $(".success_message").show();
                    $(".success_message").text(response.message);
                }
            })
        })
    })
</script>
@endsection
