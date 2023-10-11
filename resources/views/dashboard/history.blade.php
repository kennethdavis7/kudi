@extends("layout.main")


@section("body")
@include("layout.sidebar")
<style>
    #histories {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 768px) {
        #histories {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        #histories {
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
            <h1 class="mb-3">Histories</h1>
        </div>
        <hr class="mb-5">
        <div class="col-md-4 mb-0">
            <div class="d-flex">
                <select name="filter" id="filter" class="form-control">
                    <option value="">- Filter History -</option>
                    <option value="day">Last 24 hours</option>
                    <option value="days">Last 3 days</option>
                    <option value="week">Last Week</option>
                    <option value="month">Last Month</option>
                    <option value="year">Last Year</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-0 mx-3">
        <div id="histories" class="gap-4"></div>
    </div>

    <div class="d-flex justify-content-end mt-5" style="margin-right:1.5rem;">
        <nav aria-label="...">
            <ul class="pagination">
            </ul>
        </nav>
    </div>
</div>

<div class="modal hide fade" tabindex="-1" id="modalRateExperience">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rate Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label for="rating">Rating</label>
                    <select class="form-control mt-1" id="rating" name="rating">
                        <option value="">- Pilih Rating -</option>
                        <option value="5">5 - Sangat Memuaskan</option>
                        <option value="4">4 - Memuaskan</option>
                        <option value="3">3 - Oke</option>
                        <option value="2">2 - Buruk</option>
                        <option value="2">1 - Sangat Buruk</option>
                        <option value="0">0 - Gagal</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="comment">Komentar</label>
                    <textarea class="form-control mt-1" id="comment" name="comment" placeholder="Masukkan komentar..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id='submitRateExperience' class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    let historyDatas;
    let historyClicked = null;

    $(document).ready(function() {
        let currentPage = 1;
        let totalPages = 1;


        fetchData();

        function limit(string = '', limit = 0) {
            return string.substring(0, limit) + "...";
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

        function fetchData() {
            const filterQuery = $('#filter').val();
            const filter = filterQuery === '' ? 'all' : filterQuery;

            $.ajax({
                type: "GET",
                url: `/histories/fetchData/${filter}/?page=${currentPage}`,
                dataType: "json",
                success: function(response) {
                    totalPages = Math.ceil(response.recipes.total / response.recipes.per_page);
                    let html = '';
                    $("#histories").html("");

                    historyDatas = response.recipes.data

                    console.log(historyDatas)

                    $.each(response.recipes.data, function(i, recipe) {
                        html += `
                            <div class="card h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <img class="card-img-top" style="width: 100%; height: 15rem; object-fit: cover;" src="{{ asset('storage/' . '${recipe.recipe_img}') }}" alt="">
                                    <div class="card-body">
                                        <div>
                                            <div class="justify-content-between">
                                                <h5 class="card-title mr-4">${recipe.recipe_name}</h5>
                                                <p class="card-subtitle" style="font-size:15px;">Dibuat ` + dateTimeToLocale(recipe.pivot.created_at) + `</p>
                        `;

                        html += `
                                    </div>
                    `;

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
                            <button class="btn btn-success mx-2 mb-2 rate-experience" onclick=clickedRating(${recipe.pivot.id}) data-bs-toggle="modal" data-bs-target="#modalRateExperience">
                                <img src="{{asset('img/rate.png')}}" alt="" style="width: 1.5rem; margin-right: 0.3rem;">
                                <span>Rate Experience</span>
                            </button>
                        </div>
                        `;
                    });

                    $("#histories").append(html);
                    addPaginationControls(response.recipes);
                }

            })
        }

        function dateTimeToLocale(date) {
            // Input date string
            const inputDateString = date;

            // Create a Date object from the input string
            date = new Date(inputDateString);

            // Define an array for month names
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            const day = dayNames[date.getUTCDay()];
            const dayOfMonth = date.getUTCDate();
            const month = monthNames[date.getUTCMonth()];
            const year = date.getUTCFullYear();

            const hours = String(date.getUTCHours()).padStart(2, '0');
            const minutes = String(date.getUTCMinutes()).padStart(2, '0');
            const seconds = String(date.getUTCSeconds()).padStart(2, '0');

            let formattedDateString = `${day}, ${dayOfMonth} ${month} ${year} ${hours}:${minutes}:${seconds}`;

            return formattedDateString;
        }

        $(document).on("change", "#filter", () => goToPage(1));

        $('#submitRateExperience').click(function() {
            swal.showLoading()

            const data = {
                'rating': $("#rating").val(),
                'comment': $("#comment").val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "patch",
                data: data,
                url: "/histories/addRatingExperience/" + historyClicked,
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        $("#modalRateExperience").modal("hide");
                        fetchData();

                        swal.close()
                        swal.fire('Success', response.success, 'success');
                    }
                }
            });
        })
    })

    function clickedRating(history_id) {
        historyClicked = history_id

        $('#rating').val(historyDatas.find(x => x.pivot.id == history_id).pivot.rating)
        $('#comment').val(historyDatas.find(x => x.pivot.id == history_id).pivot.comment)
    };
</script>
@endsection