@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container overflow-hidden">
    <div class="overflow-hidden mt-5 mx-3 gap-4" style="display: grid; grid-template-columns: 7fr 5fr; grid-template-rows: 1fr; max-height: 100%;">
        <div class="px-2 overflow-scroll relative" style="padding-bottom: 4rem;">
            <div>
                <h1>{{ $recipe->recipe_name }}</h1>
                <hr>
                <img src="{{$recipe->recipe_img}}" style="width: 100%; height: 20rem; object-fit: cover;" class="w-100" alt="Fried Rice">
            </div>

            <div class="box p-4" style="max-height: 100%;">
                <h3>Description</h3>
                <p>{{$recipe->description}}</p>
                <hr>
                <h3>Ingredients</h3>

                <ul class="list-group list-group-flush">
                    @foreach($ingredients as $ingredient)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        @if($ingredient->missing_quantity > 0)
                        <span class="text-danger">{{ $ingredient->type }} (missing {{ number_format($ingredient->missing_quantity, 1, ',', '.') }} {{ $ingredient->unit }})</span>
                        <span class="badge bg-danger d-flex align-middle rounded-pill">{{ $ingredient->qty }} {{ $ingredient->unit }}</span>
                        @else
                        <span>{{ $ingredient->type }}</span>
                        <span class="badge bg-primary rounded-pill">{{ $ingredient->qty }} {{ $ingredient->unit }}</span>
                        @endif
                    </li>
                    @endforeach

                    <!-- <li class="list-group-item d-flex justify-content-between align-items-start">
                        <span class="text-primary">Wortel</span>
                        <span class="badge bg-primary d-flex align-middle rounded-pill">61 gr</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <span class="text-danger">Tepung Kentucky</span>
                        <span class="badge bg-danger d-flex align-middle rounded-pill">75 gr</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <span class="text-danger">Air</span>
                        <span class="badge bg-danger d-flex align-middle rounded-pill">100 mL</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <span class="text-danger">Minyak Goreng</span>
                        <span class="badge bg-danger d-flex align-middle rounded-pill">Optional</span>
                    </li> -->
                </ul>
            </div>
        </div>
        <div>
            <div class="box p-4 overflow-auto">
                <h3>Procedure</h3>
                <hr>
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 1</div>
                            Bersihkan kulit wortel dan cuci bersih.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 2</div>
                            Iris wortel tipis memanjang. Sisihkan.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 3</div>
                            Larutkan 1 bungkus Tepung Kentucky dengan air sampai larut.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 4</div>
                            Masukkan irisan wortel kedalam adonan basah sampai tercampur rata.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 5</div>
                            Masukkan ke tepung kering Tepung Kentucky sambil ditekan ringan sampai tepung menempel, lalu goreng dalam minyak hingga kecoklatan.
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah 7</div>
                            Angkat dan tiriskan. Wortel Crispy siap disajikan.
                        </div>
                    </li>
                </ol>
            </div>
            <button type="button" class="btn btn-secondary mt-4" style="width: 100%;">Gunakan bahan dalam penyimpanan</button>
        </div>
    </div>
</div>
@endsection