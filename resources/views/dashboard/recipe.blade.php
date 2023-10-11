@extends("layout.main")


@section("body")
@include("layout.sidebar")
<style>
    #recipes {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 768px) {
        #recipes {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        #recipes {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        <div class="alert alert-success alert-dismissible fade show success_message" style="display:none;" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Recipes</h1>
            <div class="rounded bg-budget text-light px-3 py-2"><span id="percentage-budget"></span>% of budget used up</div>
        </div>
        <hr class="mb-5">
        <div class="col-md-12 mb-0 d-flex align-items-center justify-content-between">
            <div class="w-25" role="search">
                <input class="form-control me-2 search" id="search" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="dropdown" style=" width: 15rem;">
                <select class="multiple-tags w-100" style="height:50px;" name="tags[]" multiple="multiple">
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-0 mx-3">
        <div id="recipes" class="gap-4"></div>
    </div>


    <div class="container-pagination d-flex justify-content-end mt-5" style="margin-right:1.5rem;">
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
        $('.js-example-basic-multiple').select2();
        $('ul.dropdown-menu').on('click', function(event) {
            event.stopPropagation();
        });

        let currentPage = 1;
        let totalPages = 1;

        fetchData();
        getPercentageBudget();

        function limit(string = '', limit = 0) {
            return string.substring(0, limit) + "...";
        }

        function getPercentageBudget() {
            $.ajax({
                type: "GET",
                url: "/budget/percentage",
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $("#percentage-budget").text(response.percentage.toFixed(1));
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

        function addPaginationControls(recipes) {
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
                const link = recipes.links[pageNumber];
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

        function fetchData() {
            const rawSearchQuery = $('.search').val();
            const cleanSearch = rawSearchQuery.trim().length === 0 ? 'all' : rawSearchQuery;

            const tag = $(".multiple-tags").val();

            const search = JSON.stringify({
                search: cleanSearch,
                tags: tag
            })


            $.ajax({
                type: "GET",
                url: `/recipes/fetchData/${search}/?page=${currentPage}`,
                dataType: "json",
                success: function(response) {
                    $("#recipes").html("");

                    let html = '';
                    if (response.recipes.data.length === 0) {
                        $("#recipes").append("<h3 class='empty-data text-center'>Not Found</h3>");
                        $("#recipes").addClass("d-flex justify-content-center");
                        $(".container-pagination").addClass("d-none");
                        return;
                    };

                    $("#recipes").removeClass("d-flex justify-content-center");
                    $(".container-pagination").removeClass("d-none");
                    console.log(response);
                    $.each(response.recipes.data, function(i, recipe) {
                        $("#filter-tags").html("");
                        html += `
                            <div class="card h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <img class="card-img-top" style="width: 100%; height: 15rem; object-fit: cover;" src="{{ asset('storage/' . '${recipe.recipe_img}') }}" alt="">
                                    <div class="card-body">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title mr-4">${recipe.recipe_name}</h5>
                                                
                        `;

                        if (recipe.is_favourited > 0) {
                            html += `
                            <img src="{{ asset('img/heart-red.png') }}" data-recipe-id="${recipe.id}" id="favorite-${recipe.id}" class="favorite-red" style="width: 1.5rem; height: 1.5rem;">
                            `;
                        } else {
                            html += `
                            <img src="{{ asset('img/heart-black.png') }}" data-recipe-id="${recipe.id}" id="favorite-${recipe.id}"  class="favorite-black" style="width: 1.5rem; height: 1.5rem;">
                            `;
                        }

                        html += `
                                    </div>
                            `;

                        for (const tag of response.tags) {
                            if (tag.recipe_name === recipe.recipe_name) {
                                html += `
                                <span class="badge text-bg-${tag.color}">${tag.tag}</span>
                                `;
                            }
                        }

                        html += `
                            <div class="my-2 text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-clock"></i>
                                <span>${convertDuration(recipe.cook_time)}</span>
                            </div>
                        `;

                        if (recipe.missing_quantity > 0) {
                            html += `
                                <span class="text-danger">
                                    Kekurangan bahan
                                </span>
                            `;
                        }

                        html += `
                                        <p class="card-text mt-3">
                                            ${limit(recipe.description ?? '', 100)}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <a href="/recipes/detail/${recipe.id}" class="btn btn-secondary mx-2 mb-2">
                                <img src="{{asset('img/view.png')}}" alt="" style="width: 1.5rem; margin-right: 0.3rem;">
                                <span>View Recipe</span>
                            </a>
                        </div>
                        `;
                    });
                    $("#recipes").append(html);
                    addPaginationControls(response.recipes);
                }

            })
        }

        fetchTags()

        function fetchTags() {
            $.ajax({
                type: "GET",
                url: '/recipes/getTags',
                success: function(response) {
                    console.log(response)
                    $.each(response.tags, function(i, item) {
                        $(".multiple-tags").append(`
                            <option value="${item.id}">${item.tag}</option>
                        `)
                    })
                }
            })
        }

        $(document).ready(function() {
            $('.multiple-tags').select2({
                placeholder: "Select tags",
                allowClear: true,
            });

            $(document).on('change', '.multiple-tags', function(e) {
                goToPage(1)
            })
        });

        $(document).on("input", ".search", () => goToPage(1));

        $(document).on("input", ".dropdown .dropdown-menu .input-tag", () => {
            goToPage(1)
        });

        $(document).on("click", ".favorite-black", function() {
            const recipeId = {
                "recipe_id": $(this).data("recipe-id")
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: `/favorites`,
                data: recipeId,
                dataType: "json",
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $(`#favorite-${recipeId.recipe_id}`).attr('src', '<?= asset('img/heart-red.png'); ?>')
                        fetchData();
                    }
                },
            })
        })

        $(document).on("click", ".favorite-red", function() {
            const recipeId = $(this).data("recipe-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: `/favorites/${recipeId}`,
                dataType: "json",
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $(`#favorite-${recipeId}`).attr('src', '<?= asset('img/heart-black.png'); ?>')
                        fetchData();
                    }
                },
            })
        })
    })
</script>
@endsection