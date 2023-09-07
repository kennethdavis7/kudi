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
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3 mb-5">
                <div class="col-md-6">
                    <div id="recipeIngredient"></div>
                    <div class="btn border border-secondary text-secondary w-100 mt-3" id="addIngredient">Add Ingredient</div>
                </div>
                <div class="col-md-5">
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
        n = 1;
        i = 1;

        addInputIngredient();

        function addInputIngredient() {
            $inputIngredient = `
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="ingredient" class="form-label">Ingredient ${n}</label>
                        <input class="form-control inputIngredient" list="ingredients-${n}" id="ingredient-${n}" data-id=${n} name="ingredient" placeholder="Type to search...">
                        <datalist id="ingredients-${n}">
                            @foreach($types as $type)
                            <option data-value="{{ $type->id }}" value="{{ $type->type }}" data-option="${i}"></option>
                            `;
            i++;

            $inputIngredient += `@endforeach
                        </datalist>
                    </div>
                    <div class="col-md-4">
                        <label for="inputUnit" class="form-label">Qty ${n}</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputUnit" class="form-label">Unit ${n}</label>
                        <select id="unit-${n}" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            `
            $("#recipeIngredient").append($inputIngredient);
            n++;
        }

        $(document).on('click', '#addIngredient', function() {
            addInputIngredient();
        })

        $(document).on('change', '.inputIngredient', function(e) {
            const shownId = $(this).data("id");
            const shownVal = $("#ingredient-" + shownId).val();
            const id = $("#ingredients-" + shownId + " option[value='" + shownVal + "']").data("value");
            console.log(id);
            fetchUnits(id, shownId);
        });

        function fetchUnits(ingredientTypeId, shownId) {
            const data = {
                'type': $('#ingredient').val(),
            };

            const url = `ingredients/${ingredientTypeId}/getUnit`;

            $.ajax({
                type: "GET",
                url,
                success: function(response) {
                    $(`#unit-${shownId}`).html("");
                    $.each(response.units, function(i, item) {
                        $(`#unit-${shownId}`).append(`<option value="${item.id}">${item.name}</option>`);
                    })
                }
            })
        }
    })
</script>
@endsection