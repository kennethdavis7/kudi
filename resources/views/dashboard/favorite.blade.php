@extends("layout.main")

@section("body")
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
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mb-0 mx-3">
        <div class="alert alert-success alert-dismissible fade show success_message" style="display:none;" role="alert">
            <button type="button rounded " class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Favorites</h1>
            <div class="text-light px-3 py-2"><span id="percentage-budget"></span>% of budget used up</div>
        </div>
        <hr class="mb-5">
        <div class="col-md-4 mb-0">
            <div class="d-flex" role="search">
                <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-0 mx-3">
        <div id="recipes" class="gap-4"></div>
    </div>


    <div class="d-flex justify-content-end mt-5" style="margin-right:1.5rem;">
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

        $(document).on("input", ".search", () => goToPage(1));

        function fetchData() {
            const rawSearchQuery = $('.search').val();
            const search = rawSearchQuery.trim().length === 0 ? 'all' : rawSearchQuery;

            $.ajax({
                type: "GET",
                url: `/favorites/fetchData/${search}/?page=${currentPage}`,
                dataType: "json",
                success: function(response) {
                    let html = '';
                    $("#recipes").html("");
                    $.each(response.recipes.data, function(i, recipe) {

                        html += `
                    <div id="card-${recipe.id}">
                        <div  class="card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <img class="card-img-top" style="width: 100%; height: 15rem; object-fit: cover;" src="${recipe.recipe_img}" alt="Card image cap">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title">${recipe.recipe_name}</h5>
                    `;

                        html += `
                        <img src="{{ asset('img/heart-red.png') }}" data-recipe-id="${recipe.id}" class="favorite" style="width: 1.5rem; height: 1.5rem;">
                        `;

                        html += `
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
                                            ${limit(recipe.description,100)}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <a href="/recipes/detail/${recipe.id}" class="btn btn-secondary mx-2 mb-2">
                                <img src="{{asset('img/view.png')}}" alt="" style="width: 1.5rem; margin-right: 0.3rem;">
                                <span>View Recipe</span>
                            </a>
                        </div>
                    </div>
                    `;

                    });

                    $("#recipes").append(html);
                    addPaginationControls(response.recipes);
                }

            })
        }

        $(document).on("click", ".favorite", function() {
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
                        $(`#card-${recipeId}`).remove();
                    }
                },
            })
        })
    })
</script>
@endsection