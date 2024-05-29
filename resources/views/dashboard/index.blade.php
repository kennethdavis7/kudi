@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mx-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Dashboard</h1>
            <div class="text-light px-3 py-2 bg-budget rounded "><span id="percentage-budget"></span>% of budget used up</div>
        </div>
        <hr class="mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Ingredient Stocks</h6>
                    <h6 class="card-subtitle mb-2 text-secondary">{{$ingredientCount }} ingredients</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Longest Duration Kept</h6>
                    <h6 class="card-subtitle mb-2 text-secondary" id="longest-duration-kept">
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-4" style="display:flex;">Monthly Budget</h6>
                        <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#budget-modal"></i>
                    </div>
                    <h6 class="card-subtitle mb-2 text-secondary" id="budget">
                    </h6>
                </div>
            </div>
        </div>
        <h3 class="mt-5">Expenses</h3>

        <div class="row">
            <div class="col-md-12" style="position: relative; min-height: 24rem;">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>

    <div class="modal fade" id="budget-modal" tabindex="-1" aria-labelledby="exampleMmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="editBudgets">
                <input type="hidden" id="edit-id" name="id">
                <div class="modal-header">
                    <div id="form_message"></div>
                    <h1 id="entry-modal-title" class="modal-title fs-5 modal-title" id="exampleModalLabel">Edit Budget</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="price" class="form-label">Budget</label>
                        <input type="number" inputmode="numeric" class="form-control" id="edit-budget" name="budget">
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

</div>
@endsection

@section ("script")
<script>
    const longestDurationKeptEl = $('#longest-duration-kept');
    const longestDurationKept = <?php echo $longestDurationKept ?>;

    if (longestDurationKept !== -1) {
        longestDurationKeptEl.text(moment.duration(longestDurationKept, 's').humanize());
    } else {
        longestDurationKeptEl.text('-');
    }

    const ctx = $('#myChart');
    const monthlyExpense = <?php echo json_encode($monthlyExpense) ?>;

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Expenses',
                data: monthlyExpense,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                },
            },
        },
    });

    $(window).on('beforeprint', () => {
        chart.resize(600, 600);
    });

    $(window).on('afterprint', () => {
        chart.resize();
    });

    $(document).ready(function() {
        getBudget();
        getPercentageBudget();

        function getBudget() {
            $.ajax({
                type: "GET",
                url: "/budget",
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        const moneyFormatter = Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                        });

                        $("#edit-budget").val(response.budget);
                        $("#budget").text(moneyFormatter.format(response.budget));
                    }
                }
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

        $(document).on('submit', '#budget-modal form', function(e) {
            const data = {
                'budget': $("#edit-budget").val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/budget",
                data: data,
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {
                        getBudget();
                        $("#create").modal("hide");
                    }
                }
            })
        })
    })
</script>
@endsection