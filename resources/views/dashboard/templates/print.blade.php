@extends("layout.main")


@section("body")
<div class="container">
    <div class="row">
        <!-- <button id="btn-print">print</button> -->

        <h1 class="text-center my-4">{{$recipe->recipe_name}}</h1>
        <hr>
        <div class="row content ">
            <img src="{{asset('storage/' . $recipe->recipe_img)}}" style="width: 100%; height: 300px; object-fit: cover;" class="w-100" alt="">
            <div class="col-6 mt-4 left-column">
                <h4>Description</h4>
                <p class="mt-2 text-justify" style="font-size: 10px;">{{$recipe->description}}</p>
                <i class="bi bi-clock"><span id="cook-time" style="font-size: 15px;"></span></i>
                <hr>
                <h4>Ingredients</h4>
                <ul class="list-group list-group-flush">
                    @foreach($ingredients as $ingredient)
                    <li class="list-group-item d-flex justify-content-between" style="font-size: 10px;">
                        <span>{{ $ingredient->type }}</span>
                        <span>{{ $ingredient->qty }} {{ $ingredient->abbreviation }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="right-column mt-4 col-6">
                <h4>Procedures</h4>
                <hr>
                <ol class="list-group">
                    @foreach ($steps as $step)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto" style="font-size: 10px;">
                            <div class="fw-bold">Langkah {{ $step->order }}</div>
                            {{ $step->name }}
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $("#btn-print").click(function() {
        window.print();
    });

    convertDuration();

    function convertDuration() {
        let cookTime = <?php echo $recipe->cook_time ?>;
        if (cookTime % 60 !== 0) {

            $("#cook-time").text(" " + cookTime + " seconds")
            return;
        }

        cookTime /= 60;
        if (cookTime % 60 !== 0 || cookTime < 60) {
            $("#cook-time").text(" " + cookTime + " minutes")
            return;
        }

        cookTime /= 60;
        $("#cook-time").text(" " + cookTime + " hours")
    }
    window.print();
    window.location = '/user-recipes';
</script>
@endsection