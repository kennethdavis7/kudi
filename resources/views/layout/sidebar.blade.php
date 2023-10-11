<div class="d-flex flex-column flex-shrink-0 p-3 rounded" style="position: sticky; top: 0; bottom:100%; min-height:100vh; min-width:160px; max-width: 280px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
  <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none my-4">
    <img src="{{ asset('img/kudi.png') }}" class="bi pe-none me-2" width="35"></img>
    <span class="fs-4">KuDi</span>
  </a>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="mb-1">
      <a href="/dashboard" class="refreshStorage nav-link link-body-emphasis d-flex align-items-center {{$active == 'dashboard' ? 'active-sd' : ''}}">
        <img src="{{asset('img/dashboard.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Dashboard
      </a>
    </li>
    <li class="mb-1">
      <a href="/ingredients" class="refreshStorage nav-link link-body-emphasis d-flex align-items-center {{$active == 'ingredient' ? 'active-sd' : ''}}">
        <img src="{{asset('img/harvest.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Ingredients
      </a>
    </li>
    <li class="mb-1">
      <a href="/recipes" class="refreshStorage nav-link link-body-emphasis d-flex align-items-center  {{$active == 'recipe' ? 'active-sd' : ''}}">
        <img src="{{asset('img/recipe-book.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Recipes
      </a>
    </li>
    <li>
      <a href="/histories" class="nav-link link-body-emphasis d-flex align-items-center  {{$active == 'history' ? 'active-sd' : ''}}">
        <img src="{{asset('img/history.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Histories
      </a>
    </li>
    <li class="mb-1">
      <a href="/favorites" class="refreshStorage nav-link link-body-emphasis d-flex align-items-center  {{$active == 'favorite' ? 'active-sd' : ''}}">
        <img src="{{asset('img/heart-black.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Favourites
      </a>
    </li>
    <li class="mb-1">
      <a href="/user-recipes" class="refreshStorage nav-link link-body-emphasis d-flex align-items-center {{$active == 'user recipe' ? 'active-sd' : ''}}">
        <img src="{{asset('img/recipe-book.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Your Recipes
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{asset('storage/' . auth()->user()->image)}}" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong>{{auth()->user()->name}}</strong>
    </a>

    <ul class="dropdown-menu text-small shadow">
      <li><a class="dropdown-item" href="/logout">Log Out</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="/profile">Profile</a></li>
    </ul>
  </div>
</div>