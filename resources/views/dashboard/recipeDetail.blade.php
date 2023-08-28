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
                        <span class="text-danger">{{ $ingredient->type }} (missing {{ $ingredient->missing_quantity }})</span>
                        <span class="badge bg-danger d-flex align-middle rounded-pill">{{ $ingredient->qty }}</span>
                        @else
                        <span>{{ $ingredient->type }}</span>
                        <span class="badge bg-primary rounded-pill">{{ $ingredient->qty }}</span>
                        @endif
                    </li>
                    @endforeach
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
                            <div class="fw-bold">Step 1</div>
                            Content for list item
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Step 2</div>
                            Content for list item
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Step 3</div>
                            Content for list item
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection