@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container">
    <div class="row mt-5 mx-3">
        <h1 class="mb-3">Dashboard</h1>
        <hr class="mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ingredient Stocks</h5>
                        <h5 class="card-subtitle mb-2 text-secondary">{{ $ingredientCount }} ingredients</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Longest Duration Kept</h5>
                        <h5 class="card-subtitle mb-2 text-secondary" id="longest-duration-kept"></h5>
                </div>
            </div>
        </div>
        <h3 class="mt-5">Expense</h3>

        <div class="row">
            <div class="col-md-9">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>
</div>
@endsection

@section ("script")
<script>
    const longestDurationKeptEl = $('#longest-duration-kept');
    const longestDurationKept = <?php echo $longestDurationKept ?>;

    console.log(longestDurationKept);

    if (longestDurationKept !== -1) {
        longestDurationKeptEl.text(moment.duration(longestDurationKept, 's').humanize());
    } else {
        longestDurationKeptEl.text('-');
    }

    const ctx = $('#myChart');
    const monthlyExpense = <?php echo json_encode($monthlyExpense) ?>;

    new Chart(ctx, {
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
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection