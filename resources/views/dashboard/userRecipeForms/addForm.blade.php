@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <form id="add-form">
        @csrf

        <div class="row mt-5 mb-0 mx-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="mb-3">Add Recipe</h1>
                <button id="addRecipeButton" class="btn btn-secondary">Add Recipe</button>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="recipeName" class="form-label">Recipe Name</label>
                    <input type="text" class="form-control" id="recipeName" name="name" placeholder="Nasi Goreng" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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
    const INGREDIENTS_KEY = 'add-form-ingredients';
    const STEPS_KEY = 'add-form-steps';
    const RECIPE_NAME_KEY = 'add-form-recipe-name';
    const DESCRIPTION_KEY = 'add-form-recipe-description';

    let ingredients = [], steps = [];
    hydrateSavedFields();

    function hydrateSavedFields() {
        ingredients = JSON.parse(localStorage.getItem(INGREDIENTS_KEY)) || Array.from(
            { length: 3 },
            () => ({
                typeId: null,
                qty: 0,
                unitId: null,
            })
        );

        steps = JSON.parse(localStorage.getItem(STEPS_KEY)) || Array.from(
            { length: 3 },
            () => '',
        );
    }

    /**
     * -- Base.
     */
    $(document).ready(function() {
        function clearSavedFields() {
            localStorage.removeItem(INGREDIENTS_KEY);
            localStorage.removeItem(STEPS_KEY);
            localStorage.removeItem(RECIPE_NAME_KEY);
            localStorage.removeItem(DESCRIPTION_KEY);

            hydrateSavedFields();
        }

        /**
         * Prevent enter from submitting the form.
         */
        $('#add-form').on('keypress', function(e) {
            const isInput = e.target.tagName.toLowerCase() === 'input';

            if (isInput && e.keyCode === 13) {
                e.preventDefault();
            }
        });

        $('#add-form').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            /**
             * Make sure there is at least 1 ingredient and at least 1 step.
             */
            if (ingredients.length === 0 || steps.length === 0) return;

            ingredients.forEach((ingredient, idx) => {
                formData.append(`ingredients[${idx}][type_id]`, ingredient.typeId);
                formData.append(`ingredients[${idx}][qty]`, ingredient.qty);
                formData.append(`ingredients[${idx}][unit_id]`, ingredient.unitId);
            });

            steps.forEach((step, idx) => {
                formData.append(`steps[${idx}]`, step);
            });

            /**
             * Make sure every field is filled (and that they're greater than 0).
             */
            for (const [key, value] of formData.entries()) {
                console.log(key, value, !value);
                if (!value) return;
            }

            $.ajax({
                method: 'POST',
                url: '/user-recipes',
                data: formData,
                contentType: false,
                processData: false,
                success(_1, _2, xhr) {
                    if (xhr.status !== 204) return;

                    clearSavedFields();
                    window.location = '/user-recipes';
                }
            });
        });
    })

    /**
     * -- Recipe details.
     */
    $(document).ready(function() {

        $('#recipeName').val(localStorage.getItem(RECIPE_NAME_KEY));
        $('#description').val(localStorage.getItem(DESCRIPTION_KEY));

        $(document).on('input', '#recipeName', function() {
            const value = $(this).val();
            localStorage.setItem(RECIPE_NAME_KEY, value);
        });

        $(document).on('input', '#description', function() {
            const value = $(this).val();
            localStorage.setItem(DESCRIPTION_KEY, value);
        });
    });

    /**
     * -- Steps.
     */
    $(document).ready(function() {

        renderInputSteps();

        function addInputStep() {
            steps.push('');
            saveAndRefreshSteps();
        }

        function removeInputStep(index) {
            steps.splice(index, 1);
            saveAndRefreshSteps();
        }

        function saveAndRefreshSteps() {
            saveInputSteps();
            renderInputSteps();
        }

        function renderInputSteps() {
            $("#recipeSteps").html("");

            for (let i = 0; i < steps.length; i++) {
                const step = steps[i];

                const inputStep = `
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="step" class="form-label">Step ${i + 1}</label>
                            <button class="delete-step btn" data-index="${i}" type="button">
                                <img src={{asset('img/multiply.png');}} width="20" height="20">
                            </button>
                        </div>

                        <input
                            type="text"
                            class="form-control step-input"
                            data-index="${i}"
                            value="${step}"
                            required
                        >
                    </div>
                `;


                $("#recipeSteps").append(inputStep);
            }
        }

        function saveInputSteps() {
            localStorage.setItem(STEPS_KEY, JSON.stringify(steps));
        }

        $(document).on('click', '#addStep', addInputStep);

        $(document).on('click', '.delete-step', function() {
            const index = $(this).data("index");
            removeInputStep(Number.parseInt(index, 10));
        });

        $(document).on('input', '.step-input', function(e) {
            const index = $(this).data("index");
            const value = $(this).val();

            steps[index] = value;
            saveInputSteps();
        });
    });

    /**
     * -- Ingredients.
     */
    $(document).ready(function() {
        const allTypes = <?php echo json_encode($types); ?>;

        renderInputIngredients();
        fetchUnitsForAll();

        function addInputIngredient() {
            ingredients.push({
                qty: 0,
                typeId: null,
                unitId: null,
            });

            saveAndRefreshIngredients();
        }

        function removeInputIngredient(index) {
            ingredients.splice(index, 1);
            saveAndRefreshIngredients();
        }

        function saveAndRefreshIngredients() {
            saveInputIngredients();
            renderInputIngredients();
            fetchUnitsForAll();
        }

        function renderInputIngredients() {
            $("#recipeIngredients").html("");

            for (let i = 0; i < ingredients.length; i++) {
                const {
                    typeId,
                    qty,
                } = ingredients[i];

                const selectedType = allTypes.find((type) => type.id === typeId)?.type;

                const html = `
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="ingredient" class="form-label">Ingredient ${i + 1}</label>
                                <input
                                    class="form-control ingredient-type-input"
                                    list="ingredients-list-${i}"
                                    data-index="${i}"
                                    autocomplete="off"
                                    placeholder="Type to search..."
                                    ${selectedType != null ? `value="${selectedType}"` : ''}
                                    required
                                >

                                <datalist id="ingredients-list-${i}">
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <label for="inputUnit" class="form-label">Qty ${i + 1}</label>
                                <input
                                    type="number"
                                    class="form-control ingredient-qty-input"
                                    value="${qty}"
                                    data-index="${i}"
                                    min="1"
                                    required
                                >
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label for="inputUnit" class="form-label">Unit ${i + 1}</label>
                                    <button class="btn delete-ingredient" data-index="${i}">
                                        <img src={{asset('img/multiply.png');}} style="width: 20px; height: 20px;">
                                    </button>
                                </div>

                                <select
                                    id="unit-${i}"
                                    class="form-control ingredient-unit-select"
                                    data-index="${i}"
                                    required
                                ></select>
                            </div>
                        </div>
                    </div>
                `;

                $("#recipeIngredients").append(html);
                renderIngredientTypesFor(i);
            }
        }

        function renderIngredientTypesFor(index) {
            const types = allTypes
                .filter((type) => {
                    const isNotDuplicate = !ingredients.some((ig) => ig.typeId === type.id);
                    const isThisIngredient = ingredients[index].typeId === type.id;

                    return isThisIngredient || isNotDuplicate;
                });

            const html = types.map((type) => {
                    return `<option class="ingredient-option" data-id="${type.id}" value="${type.type}">${type.type}</option>`;
                }).join('');

            $(`#ingredients-list-${index}`).html(html);
        }

        function saveInputIngredients() {
            localStorage.setItem(INGREDIENTS_KEY, JSON.stringify(ingredients));
        }

        function updateIngredient(ingredientIndex, property, value) {
            ingredients[ingredientIndex][property] = value;
            saveInputIngredients();
        }

        $(document).on('click', '#addIngredient', function() {
            addInputIngredient();
        })

        $(document).on('click', '.delete-ingredient', function() {
            const index = $(this).data("index");
            removeInputIngredient(Number.parseInt(index, 10));
        })

        function fetchUnits(index) {
            const unitsElementId = `#unit-${index}`;
            const ingredientId = ingredients[index].typeId;

            $(unitsElementId).html("");

            if (ingredientId == null) return;

            $.ajax({
                type: "GET",
                url: `/ingredients/${ingredientId}/getUnit`,
                success: function(response) {
                    $.each(response.units, function(i, item) {
                        const isSelected = ingredients.find((ig) => ig.typeId === ingredientId)?.unitId === item.id;
                        $(unitsElementId).append(`<option ${isSelected ? 'selected' : ''} value="${item.id}">${item.name}</option>`);
                    });

                    saveIngredientUnit(unitsElementId);
                }
            })
        }

        function fetchUnitsForAll() {
            for (let i = 0; i < ingredients.length; i++) {
                fetchUnits(i);
            }
        }

        /**
         * Serialization event handlers.
         */
        function saveIngredientUnit(el) {
            const index = $(el).data("index");
            const value = $(el).val();

            updateIngredient(index, 'unitId', Number.parseInt(value, 10));
        }

        $(document).on('input', '.ingredient-qty-input', function() {
            const index = $(this).data("index");
            const value = $(this).val();

            updateIngredient(index, 'qty', Number.parseInt(value, 10));
        });

        $(document).on('change', '.ingredient-unit-select', function() {
            saveIngredientUnit(this);
        });

        $(document).on('change', '.ingredient-type-input', function() {
            const index = $(this).data("index");
            const value = $(this).val();

            /**
             * Eww.
             */
            const option = $(`option[value='${value || 'undefined'}'].ingredient-option`);
            const ingredientId = option?.data('id');

            updateIngredient(index, 'typeId', ingredientId);
            fetchUnits(index);

            for (let i = 0; i < ingredients.length; i++) {
                renderIngredientTypesFor(i);
            }
        });
    });
</script>
@endsection
