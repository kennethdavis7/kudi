@extends("layout.main")

@section("body")

@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        <div class="alert alert-success alert-dismissible fade show success_message" style="display:none;" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Ingredients</h1>
            <div class="bg-budget text-light px-3 py-2"><span id="percentage-budget"></span>% of budget used up</div>
        </div>
        <hr class="mb-5">
        <div class="col-md-3 mb-0">
            <div class="d-flex" role="search">
                <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4 text-end">
            <a href="#" class="btn btn-secondary add" data-bs-toggle="modal" data-bs-target="#create">Add Ingredient</a>
        </div>
        <div class="col-md-12">
            <table class="table w-full mt-4">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">No</th>
                        <th scope="col" style="width: 100%;">Ingredient</th>
                        <th scope="col" style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody class="tbody" id="ingredients-table"></tbody>
            </table>
        </div>
    </div>

    <!-- AddIngredientModal -->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleMmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="add-form">
                <div class="modal-header">
                    <div id="form_message"></div>
                    <h1 id="entry-modal-title" class="modal-title fs-5 modal-title" id="exampleModalLabel">Add Ingredient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ingredient" class="form-label">Ingredient</label>
                        <select class="form-select" id="ingredient" name="ingredient">
                            @foreach($ingredientTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" inputmode="numeric" class="form-control" id="price" name="price">
                        <div class="col-auto">
                            <span class="form-text price">
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="qty">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputUnit">Unit</label>
                            <select id="unit" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="entry-button" class="btn btn-primary" name="submit">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EditIngredientModal -->

    <div class="modal fade" id="editVariants" tabindex="-1" aria-labelledby="exampleMmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="editVariants">
                <input type="hidden" id="edit-id" name="id">
                <div class="modal-header">
                    <div id="form_message"></div>
                    <h1 id="entry-modal-title" class="modal-title fs-5 modal-title" id="exampleModalLabel">Edit Ingredient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" inputmode="numeric" class="form-control" id="edit-price" name="price">
                        <div class="col-auto">
                            <span class="form-text price">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="entry-button" class="btn btn-primary edit-button" name="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- DecreaseIngredientModal -->
    <div class="modal fade" id="decrease" tabindex="-1" aria-labelledby="exampleMmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="decreaseVariants">
                <input type="hidden" id="decrease-id" name="id">
                <div class="modal-header">
                    <div id="form_message"></div>
                    <h1 id="entry-modal-title" class="modal-title fs-5 modal-title" id="exampleModalLabel">Decrease Quantity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="qty">Qty</label>
                            <input type="number" class="form-control" id="qty-decrease" name="qty">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputUnit">Unit</label>
                            <select id="unit" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="entry-button" class="btn btn-primary decrease" name="submit">Decrease</button>
                </div>
            </form>
        </div>
    </div>



    <div class="d-flex justify-content-end mt-3" style="margin-right:1.5rem;">
        <nav aria-label="...">
            <ul class="pagination">
            </ul>
        </nav>
    </div>
</div>

@endsection

@section("script")
<script>
    $(document).ready(function() {
        let currentPage = 1;
        let totalPages = 1;

        fetchData();
        getPercentageBudget();

        function getPercentageBudget() {
            $.ajax({
                type: "GET",
                url: "/budget/percentage",
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $("#percentage-budget").text(response.percentage);
                        $(".bg-budget").addClass(response.color);
                    }
                }
            });
        }

        function goToPage(newPage) {
            if (newPage < 1) newPage = 1;
            if (newPage > totalPages) newPage = totalPages;

            currentPage = newPage;
            fetchData();
        }

        function addPaginationControls(ingredients) {
            $(".pagination").html("");

            const isFirstPage = currentPage === 1;
            const isLastPage = currentPage === totalPages;

            const addPaginationControl = (active, pageNumber, label, disabled = false) => {
                $(".pagination").append(`
                    <li class="page-item">
                        <button class="page-link ${disabled ? 'disabled' : ''} ${active === true ? "active-paginate" : "text-dark"}" data-page-number="${pageNumber}" ${disabled ? 'disabled' : ''}>
                            ${label}
                        </button>
                    </li>
                `);
            };

            const addPageNumber = (pageNumber) => {
                const link = ingredients.links[pageNumber];
                addPaginationControl(link.active, pageNumber, link.label);
            };

            addPaginationControl(false, 'prev', '« Previous', currentPage === 1);

            const start = currentPage - 1 + (isLastPage ? -1 : 0);
            const end = currentPage + 1 + (isFirstPage ? 1 : 0);

            for (let i = start; i <= end; i++) {
                if (i < 1 || i > totalPages) continue;
                addPageNumber(i);
            }

            addPaginationControl(false, 'next', 'Next »', currentPage === totalPages);

            $(".pagination li button").click((e) => {
                const pageNumber = e.target.getAttribute('data-page-number');
                if (pageNumber === undefined) return;

                if (pageNumber === 'prev') goToPage(currentPage - 1);
                else if (pageNumber === 'next') goToPage(currentPage + 1);
                else goToPage(Number.parseInt(pageNumber, 10));
            });
        }

        function refetchCreationTimes() {
            $.ajax({
                type: "GET",
                url: "/ingredients/creation-times",
                dataType: "json",
                success: function(response) {
                    $.each(response.ingredient_variants, function(i, variant) {
                        $(`#duration-kept-${variant.id}`).text(moment(variant.created_at).fromNow(true));
                    });
                }
            });
        }

        const moneyFormatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

        function fetchData() {
            const rawSearchQuery = $('.search').val();
            const search = rawSearchQuery.trim().length === 0 ? 'all' : rawSearchQuery;

            $.ajax({
                type: "GET",
                url: `/ingredients/fetchData/${search}/?page=${currentPage}`,
                dataType: "json",
                success: function(response) {
                    totalPages = Math.ceil(response.ingredients.total / response.ingredients.per_page);

                    $("#ingredients-table").html("");

                    $.each(response.ingredients.data, function(i, item) {
                        const accordionId = `accordion-${item.id}`;

                        let html = `
                            <tr class="accordion-toggle">
                                <td scope="col" class="align-middle">
                                    <i class="bi bi-chevron-down" data-bs-toggle="collapse" data-bs-target="#${accordionId}"></i>
                                </td>
                                <th scope="col" class="align-middle">${i + 1}</th>
                                <td scope="col" class="w-full align-middle">${item.type}</td>
                                <td scope="col" class="d-flex justify-content-center align-middle">
                                    <button type="button" data-ingredient-id="${item.id}" class="btn btn-secondary deleteTypes" style="margin-right:1rem;"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" style="padding: 0; border-bottom: none;">
                                    <div class="accordion-body collapse ingredient-row-accordion" id="${accordionId}">
                                        <table class="table w-full">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">#</th>
                                                    <th scope="col" class="text-center">Price</th>
                                                    <th scope="col" class="text-center">Quantity</th>
                                                    <th scope="col" class="text-center">Duration Kept</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tbody">
                        `;

                        for (let j = 0; j < item.ingredient_variants.length; j++) {
                            const variant = item.ingredient_variants[j];
                            html += `
                                <tr id=row-${variant.id}>
                                    <th scope="row" class="text-center align-middle">${j + 1}</th>
                                    <td class="text-center align-middle" id="buy-price-${variant.id}">${moneyFormatter.format(variant.buy_price)}</td>
                                    <td class="text-center align-middle">
                                        <span id="current-qty-${variant.id}">${variant.current_qty}</span>
                                        ${variant.unit.abbrevation}
                                    </td>
                                    <td class="text-center align-middle" id="duration-kept-${variant.id}">${moment(variant.created_at).fromNow(true)}</td>
                                    <td class="d-flex justify-content-center align-middle">
                                        <button type="button" class="btn btn-secondary editVariants" data-ingredient-id="${variant.id}" data-bs-toggle="modal" data-bs-target="#editVariants" style="margin-right:1rem;"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" data-ingredient-id="${variant.id}" class="btn btn-secondary deleteVariants" style="margin-right:1rem;"><i class="bi bi-trash"></i></button>
                                        <button type="button" data-ingredient-id="${variant.id}" class="btn btn-secondary decrease-button" data-bs-toggle="modal" data-bs-target="#decrease"><i class="bi bi-arrow-down"></i></button>
                                    </td>
                                </tr>
                            `;
                        }

                        html += `
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        `;

                        $('#ingredients-table').append(html);
                    });

                    addPaginationControls(response.ingredients);
                }
            })
        }

        $(document).on('click', '.decrease-button', function(e) {
            e.preventDefault();

            const ingredientId = $(this).data("ingredient-id");
            $("#decrease-id").val(ingredientId);
        })

        $(document).on("submit", "#decrease form", function(e) {
            e.preventDefault();
            const ingredientId = $("#decrease-id").val();
            const data = {
                'decrease': $("#qty-decrease").val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: `/ingredients/decrease/${ingredientId}`,
                dataType: "json",
                data: data,
                success: function(response) {
                    const {
                        current_qty,
                        id,
                    } = response.ingredient;

                    if (current_qty === 0) {
                        $(`#row-${id}`).remove();
                    } else {
                        $(`#current-qty-${id}`).text(current_qty);
                    }

                    $("#decrease").modal("hide");
                    $(".modal").find("input").val("");
                },
            })
        })

        $(document).on("input", ".search", () => goToPage(1));
        setInterval(refetchCreationTimes, 45 * 1000);

        $(document).on("click", ".editVariants", function(e) {
            e.preventDefault();

            const ingredientId = $(this).data("ingredient-id");

            $.ajax({
                type: "GET",
                url: "/ingredients/" + ingredientId + "/edit",
                dataType: "json",
                success: function(response) {
                    $("#edit-price").val(response.variants.buy_price);
                    $("#edit-id").val(response.variants.id);
                }
            })

        })

        $(document).on("click", ".edit-button", function(e) {
            e.preventDefault();

            const data = {
                "buy_price": $("#edit-price").val(),
                "ingredient_variants_id": $("#edit-id").val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/ingredients/" + data.ingredient_variants_id,
                data: data,
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $(".success_message").show();
                        $(".success_message").text(response.success);
                        $(".modal").modal("hide");
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $(".modal").find("input").val("");

                        $(`#buy-price-${response.id}`).text(moneyFormatter.format(response.data.buy_price));
                        $(`#current-qty-${response.id}`).text(response.data.current_qty);
                    } else {
                        for (const key in response.errors) {
                            if (key === "ingredient") {
                                $(".ingredient").text(response.errors[key]);
                            } else if (key === "price") {
                                $(".price").text(response.errors[key]);
                            } else {
                                $(".qty").text(response.errors[key]);
                            }
                        }
                    }
                }
            })
        })

        $(document).on("click", ".deleteTypes", function() {
            if (!confirm('Are you sure you want to delete this ingredient?')) return;

            const ingredientId = $(this).data("ingredient-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/ingredients/" + ingredientId,
                success: function(response) {
                    fetchData();
                    $(".success_message").show();
                    $(".success_message").text(response.message);
                }
            })
        })

        $(document).on("click", ".deleteVariants", function() {
            if (!confirm('Are you sure you want to delete this ingredient?')) return;

            const ingredientId = $(this).data("ingredient-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/ingredients/deleteVariant/" + ingredientId,
                success: function(response) {
                    $(`#row-${ingredientId}`).remove();
                    $(".success_message").show();
                    $(".success_message").text(response.message);
                }
            })
        })

        $(document).on('change', '#ingredient', function(e) {
            const id = e.target.value;

            const data = {
                'type': $('#ingredient').val(),
            }

            $.ajax({
                type: "GET",
                url: `ingredients/${id}/getUnit`,
                success: function(response) {
                    $("#unit").html("");
                    $.each(response.units, function(i, item) {
                        $("#unit").append(`<option value="${item.id}">${item.name}</option>`);
                    })
                }
            })
        });

        $(document).on('submit', '#create form', function(e) {
            e.preventDefault();

            const data = {
                'ingredient': $('#ingredient').val(),
                'price': $('#price').val(),
                'qty': $('#qty').val(),
                'unit_id': $('#unit').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/ingredients",
                data: data,
                success: function(response, _, xhr) {
                    if (xhr.status === 400) {
                        for (const key in response.errors) {
                            if (key === "ingredient") {
                                $(".ingredient").text(response.errors[key]);
                            } else if (key === "price") {
                                $(".price").text(response.errors[key]);
                            } else {
                                $(".qty").text(response.errors[key]);
                            }
                        }
                    } else if (xhr.status === 200) {
                        $(".success_message").show();
                        $(".success_message").text(response.success);

                        $("#create").modal("hide");
                        $(".modal").find("input").val("");

                        getPercentageBudget();
                        fetchData();
                    }

                }
            });
        })
    })
</script>
@endsection