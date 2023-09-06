@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <form action="">
        <div class="row mt-5 mb-0 mx-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="mb-3">Add Recipe</h1>
                <a href="/user-recipe" class="btn btn-secondary">Add Recipe</a>
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

            <div class="d-flex justify-content-between mt-3 mb-5">
                <div class="col-md-4">
                    <div id="recipeIngredient">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="ingredient" class="form-label">Ingredient 1</label>
                                    <input class="form-control" list="ingredients" id="ingredient" name="ingredient" placeholder="Type to search...">
                                    <datalist id="ingredients">
                                        @foreach($types as $type)
                                        <option data-value="{{ $type->id }}" value="{{ $type->type }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputUnit" class="form-label">Unit 1</label>
                                    <select id="unitDecrease" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn border border-secondary text-secondary w-100 mt-3" id="addIngredient">Add Ingredient</div>
                </div>
                <div class="col-md-7">
                    <div class="mb-3 step1">
                        <label for="step" class="form-label">Step 1</label>
                        <input type="text" class="form-control" id="step1">
                    </div>
                    <div class="btn border border-secondary text-secondary w-100 mt-3" id="addStep">Add Step</div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section("script")
<script>
    $(document).ready(function() {
        n = 2;
        $(document).on('click', '#addIngredient', function() {
            $inputIngredient = `
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-7">
                        <label for="ingredient" class="form-label">Ingredient ${n}</label>
                        <input class="form-control" list="ingredients" id="ingredient" name="ingredient" placeholder="Type to search...">
                        <datalist id="ingredients">
                            @foreach($types as $type)
                            <option data-value="{{ $type->id }}" value="{{ $type->type }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-md-5">
                        <label for="inputUnit" class="form-label">Unit ${n}</label>
                        <select id="unitDecrease" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            `

            n++
            $("#recipeIngredient").append($inputIngredient);
        })
    })
</script>
@endsection