<div class="d-flex flex-column flex-shrink-0 p-3 rounded" style="position: sticky; top: 0; width: 280px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
  <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none my-3">
    <img src="{{ asset('img/kudi.png') }}" class="bi pe-none me-2" width="35"></img>
    <span class="fs-4">KuDi</span>
  </a>
  <ul class="nav nav-pills flex-column mb-auto">
    <li>
      <a href="/dashboard" class="nav-link link-body-emphasis d-flex align-items-center {{$active == 'dashboard' ? 'active-sd' : ''}}">
        <img src="{{asset('img/dashboard.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Dashboard
      </a>
    </li>
    <li>
      <a href="/ingredients" class="nav-link link-body-emphasis d-flex align-items-center {{$active == 'ingredient' ? 'active-sd' : ''}}">
        <img src="{{asset('img/harvest.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Ingredients
      </a>
    </li>
    <li>
      <a href="/recipes" class="nav-link link-body-emphasis d-flex align-items-center  {{$active == 'recipe' ? 'active-sd' : ''}}">
        <img src="{{asset('img/recipe-book.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Recipes
      </a>
    </li>
    <li>
      <a href="/favorites" class="nav-link link-body-emphasis d-flex align-items-center  {{$active == 'favorite' ? 'active-sd' : ''}}">
        <img src="{{asset('img/heart-black.png')}}" width="20px" style="margin-right: 0.75rem;" alt="">
        Favourites
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong>{{auth()->user()->name}}</strong>
    </a>

    <ul class="dropdown-menu text-small shadow">
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="/logout">Log Out</a></li>
    </ul>
  </div>
</div>