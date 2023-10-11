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
                <input class="form-control me-2 search" id="search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 text-end">
            <a href="/user-recipes/create" class="btn btn-secondary add"><span>Add Recipe</span></a>
        </div>
        <div class="col-md-12">
            <table id="recipes" class="table w-full mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="tbody" id="recipes-table">
                </tbody>
            </table>
        </div>
    </div>


    <div class="container-pagination d-flex justify-content-end mt-3" style="margin-right:1.5rem;">
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

        function fetchData() {
            const rawSearchQuery = $('.search').val();
            const search = rawSearchQuery.trim().length === 0 ? 'all' : rawSearchQuery;

            $.ajax({
                type: "GET",
                url: `/user-recipes/fetch-data/${search}/?page=${currentPage}`,
                success: function(response) {
                    $("#recipes-table").html("");
                    $(".empty-data").remove();
                    if (response.data.length === 0) {
                        $("<h3 class='empty-data text-center'>Not Found</h3>").insertAfter("#recipes");
                        $(".container-pagination").addClass("d-none");
                        return;
                    };

                    $(".empty-data").remove();
                    $(".container-pagination").removeClass("d-none");

                    let html = '';
                    $("#recipes-table").html("");
                    $.each(response.data, function(i, recipe) {
                        console.log(recipe)


                        html += `
                        <tr>
                            <th scope="col" class="align-middle">${i + 1}</td>
                            <td scope="col" class="align-middle"><img src="{{ asset('storage/' . '${recipe.recipe_img}') }}" width="100px" class="shadow-sm rounded"></td>
                            <td scope="col" class="align-middle">${recipe.recipe_name}</td>`;

                        if (recipe.status !== 0) {
                            html += `<td scope="col" class="align-middle"><button type="button" id="status" data-status="${recipe.status}" data-recipe-id="${recipe.id}" class="btn btn-success">Public</button></td>`;
                        } else {
                            html += `<td scope="col" class="align-middle"><button type="button" id="status" data-status="${recipe.status}" data-recipe-id="${recipe.id}" class="btn btn-secondary">Private</button></td>`;
                        }

                        html += `
                            <td scope="col" class="align-middle">
                                <a href="/templates/print/${recipe.id}" class="btn btn-secondary print mx-3"><i class="bi bi-printer"></i></a>
                                <a href="/user-recipes/${recipe.id}/edit" class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-pencil-square"></i></a>
                                <button class="btn btn-secondary" id="delete-recipe" data-id="${recipe.id}" style="margin-right:1rem;"><i class="bi bi-trash"></i></button>
                                <a href="/recipes/detail/${recipe.id}" class="btn btn-secondary" style="margin-right:1rem;"><i class="bi bi-eye"></i> </a>
                            </td>
                        </tr>
                        `;
                    })
                    $("#recipes-table").append(html);
                    addPaginationControls(response);
                }
            })
        }

        $(document).on("input", ".search", () => goToPage(1));

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
                success: function(response) {
                    $(`#row-${id}`).remove();
                    $(".success_message").show();
                    $(".success_message").text(response.message);
                    fetchData();
                }
            })
        })

        $(document).on('click', '#status', function() {
            const status = Number.parseInt($(this).data("status"), 10);

            const data = {
                status,
                id: $(this).data("recipe-id")
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: `/user-recipes/change-status`,
                data: data,
                success: function(response) {
                    fetchData();
                }
            })
        })
    })
</script>
@endsection