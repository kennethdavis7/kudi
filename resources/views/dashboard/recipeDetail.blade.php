@extends("layout.main")


@section("body")
@include("layout.sidebar")
<div class="container overflow-hidden">
    <div class="overflow-hidden mt-5 mx-3 gap-2" style="display: grid; grid-template-columns: 7fr 5fr; grid-template-rows: 1fr; max-height: 100%;">
        <div class="px-2 overflow-scroll relative" style="padding-bottom: 4rem;">
            <div>
                <h1>{{ $recipe->recipe_name }}</h1>
                <hr>
                <img src="{{ asset('storage/' . $recipe->recipe_img) }}" style="width: 100%; height: 20rem; object-fit: cover;" class="w-100" alt="Fried Rice">
            </div>

            <div style="max-height: 100%;">
                <h3 class="mt-4">Description</h3>
                <hr>
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
                </ul>
            </div>
        </div>
        <div class="overflow-scroll relative mb-4" style="max-width:100%;">
            <div class="p-4" style="max-height: 100%; padding-bottom: 4rem;">
                <h3>Procedure</h3>
                <hr>
                <ol class="list-group">
                    @foreach ($recipe->steps as $step)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Langkah {{ $step->order }}</div>
                            {{ $step->name }}
                        </div>
                    </li>
                    @endforeach
                </ol>

                <div class="mb-5">
                    <form action="/recipes/decrease-ingredients-by-recipe/{{ $recipe->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-secondary mb-5 mt-3 decreaseIngredientsByRecipe" style="width: 100%;">Gunakan bahan dalam penyimpanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
