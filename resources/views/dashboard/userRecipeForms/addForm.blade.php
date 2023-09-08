@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <form action="" id="add-form">
        <div class="row mt-5 mb-0 mx-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="mb-3">Add Recipe</h1>
                <button id="addRecipeButton" class="btn btn-secondary">Add Recipe</button>
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
                    <div id="recipeIngredients"></div>
                    <button class="btn border border-secondary text-secondary w-100 mt-3" id="addIngredient" type="button">Add Ingredient</button>
                </div>

                <div class="col-md-5">
                    <div id="recipeSteps"></div>
                    <button class="btn border border-secondary text-secondary w-100 mt-3" id="addStep" type="button">Add Step</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section("script")
<script>
    $(document).ready(function() {

        let steps = JSON.parse(localStorage.getItem('add-form-steps')) || [{
                id: 0,
                step: '',
            },
            {
                id: 1,
                step: '',
            },
            {
                id: 2,
                step: '',
            }
        ];

        let ingredients = JSON.parse(localStorage.getItem('add-form-ingredients')) || [{
                id: null,
                name: '',
                qty: 0,
                unit: '',
            },
            {
                id: null,
                name: '',
                qty: 0,
                unit: '',
            },
            {
                id: null,
                name: '',
                qty: 0,
                unit: '',
            }
        ];;

        renderInputSteps();
        renderInputIngredient();
        checkUnit();

        $('#add-form').on('keypress', function(e) {
            const isInput = e.target.tagName.toLowerCase() === 'input';

            if (isInput && e.keyCode === 13) {
                e.preventDefault();
            }
        });

        function addInputStep() {
            const newId = steps.length;

            steps.push({
                id: newId,
                step: '',
            });

            renderInputSteps();
        }

        function removeInputStep(id) {
            steps = steps.filter((step) => {
                return step.id !== id;
            });

            renderInputSteps();
        }

        function renderInputSteps() {
            $("#recipeSteps").html("");

            for (let i = 0; i < steps.length; i++) {
                const {
                    id,
                    step,
                } = steps[i];

                const inputStep = `
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="step" class="form-label">Step ${i + 1}</label>
                            <button class="delete-step btn" data-step="${id}" type="button">
                                <img src={{asset('img/multiply.png');}} width="20" height="20">
                            </button>
                        </div>

                        <input type="text" class="form-control step-input" data-step="${id}" value="${step}">
                    </div>
                `;

                localStorage.setItem('add-form-steps', JSON.stringify(steps));

                $("#recipeSteps").append(inputStep);
            }
        }

        function addInputIngredient() {
            ingredients.push({
                id: null,
                name: '',
                qty: 0,
                unit: ''
            });

            renderInputIngredient();
        }

        function renderInputIngredient() {
            const types = (<?php echo json_encode($types); ?>)
                .filter((type) => {
                    return !ingredients.find((ig) => ig.id === type.id);
                });

            $("#recipeIngredients").html("");

            for (let i = 0; i < ingredients.length; i++) {
                const {
                    id,
                    name,
                    unit,
                    qty,
                } = ingredients[i];

                let inputIngredient = `
                    <div class="mb-3" id="inputIngredient-${id}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="ingredient" class="form-label">Ingredient ${i + 1}</label>
                                <input class="form-control select-ingredient" list="ingredients-${id}" id="ingredient-${id}" data-id="${id}" name="ingredient" value="${name}" autocomplete="off" placeholder="Type to search...">
                                <datalist id="ingredients-${id}">
                `;

                inputIngredient += types.map((type) => {
                    return `<option data-value="${type.id}" value="${type.type}"></option>`;
                }).join('');

                inputIngredient += `
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="inputUnit" class="form-label">Qty ${i + 1}</label>
                                <input type="number" class="form-control ingredient-input" data-id=${id} value=${qty} data-property="qty">
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label for="inputUnit" class="form-label">Unit ${i + 1}</label>
                                    <img class="delete-ingredient" id="delete-ingredient-${id}" data-delete-ingredient="${id}" src={{asset('img/multiply.png');}} style="width:20px; height:20px; cursor:pointer;">
                                </div>
                                <select id="unit-${id}" data-id=${id} class="form-control select-unit" data-property="unit">
                                </select>
                            </div>
                        </div>
                    </div>
                `;

                $("#recipeIngredients").append(inputIngredient);
            }
        }

        function removeInputIngredient(id) {
            ingredients = ingredients.filter((item) => {
                return item.id !== id;
            })

            checkUnit();
            renderInputIngredient();
        }

        $(document).on('click', '.delete-ingredient', function() {
            const inputIngredientId = $(this).data("delete-ingredient")
            removeInputIngredient(Number.parseInt(inputIngredientId, 10))
        })

        $(document).on('click', '.delete-step', function() {
            const id = $(this).data("step");
            removeInputStep(Number.parseInt(id, 10));
        })

        $(document).on('input', '.step-input', function(e) {
            const id = $(this).data("step");

            steps = steps.map((step) => {
                if (step.id === id) return {
                    ...step,
                    step: e.target.value,
                };

                return step;
            });

            localStorage.setItem('add-form-steps', JSON.stringify(steps));
        });

        $(document).on('change', '.select-unit', function(e) {
            const unitId = $(this).data("id");
            updateUnit(unitId, e.target.value);
        })

        function updateUnit(id, value = "0") {
            ingredients = ingredients.map((item) => {
                if (item.id === id) return {
                    ...item,
                    unit: value
                }
                return item
            })

            console.log(ingredients)

            localStorage.setItem('add-form-ingredients', JSON.stringify(ingredients));
        }

        $(document).on('input', '.ingredient-input', function(e) {
            const ingredientId = $(this).data("id");
            const property = $(this).data("property");

            ingredients = ingredients.map((ingredient) => {
                if (ingredient.id === ingredientId) return {
                    ...ingredient,
                    [property]: e.target.value,
                }

                return ingredient
            })

            localStorage.setItem('add-form-ingredients', JSON.stringify(ingredients));
        });

        $(document).on('change', '.select-ingredient', function(e) {
            const ingredientId = $(this).data("id");

            fetchUnits(ingredientId);
            updateUnit(ingredientId);

            localStorage.setItem('add-form-ingredients', JSON.stringify(ingredients));
        })

        $(document).on('click', '#addIngredient', function() {
            addInputIngredient();
            checkUnit();
        })

        $(document).on('click', '#addStep', function() {
            addInputStep();
            console.log('steps', steps);
        })

        function checkUnit() {
            for (let i = 0; i < ingredients.length; i++) {
                if (ingredients[i].unit !== '') {
                    const ingredientId = ingredients[i].id;
                    const shownVal = $("#ingredient-" + ingredientId).val();
                    const id = $("#ingredients-" + ingredientId + " option[value='" + ingredients[i].ingredient + "']").data("value");
                    fetchUnits(id, ingredientId)
                }
            }
        }

        function fetchUnits(ingredientId) {
            const url = `ingredients/${ingredientId}/getUnit`;

            $.ajax({
                type: "GET",
                url,
                success: function(response) {
                    $(`#unit-${ingredientId}`).html("");

                    $.each(response.units, function(i, item) {
                        const isSelected = ingredients.find((ig) => ig.id === ingredientId)?.unit === item.id;
                        $(`#unit-${ingredientId}`).append(`<option ${isSelected ? 'selected' : ''} value="${item.id}">${item.name}</option>`);
                    })
                }
            })
        }
    })
</script>
@endsection