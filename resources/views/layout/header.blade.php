<style>
  .nav-link:focus,
  .nav-link:hover {
    color: #050400 !important;
  }

  .navbar-nav a {
    color: #050400 !important;
  }
</style>

<body>
  <header>

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{asset('/images/logo.png  ')}}" alt="" srcset="" class="header-logo">
          <span class="header-text">
            Google Keep
          </span>
        </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav d-flex justify-content-between align-items-center">

            <a class="nav-link {{Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{route('home')}}">
              <i class="fas fa-home"></i> Home </a>

            <a class="nav-link {{Route::currentRouteName() == 'notes.create' ? 'active' : '' }}"
              href="{{route('notes.create')}}"><i class="fas fa-plus-square"></i> Add Note</a>

            <a class="nav-link {{Route::currentRouteName() == 'categories' ? 'active' : '' }}"
              href="{{route('categories')}}"><i class="fas fa-list-alt"></i> Categories</a>

            <a class="nav-link {{Route::currentRouteName() == 'tags' ? 'active' : '' }}" href="{{route('tags')}}"><i
                class="fas fa-tags"></i> Tags</a>

            <div class="px-2"></div>

            <form class="d-flex">
              <input class="form-control  me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-warning me-2 inline" type="submit"> <i class="fas fa-search"></i></button>
            </form>
            <div class="px-2"></div>
            @auth
            <div class="dropdown">
              <button class="btn dropdown-toggle bg-white shadow-sm" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->img_path)

                <img src="{{asset('/images/profiles/'.Auth::user()->img_path)}}" class="profile-img" alt="">

                @else
                <img src="{{asset('/images/profiles/default.png')}}" class="profile-img" alt="">

                @endif ()


                {{ Auth::user()->name }}
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('auth.settings')}}">
                  <i class="fas fa-user"></i> Setting</a>

                <a class="dropdown-item text-danger" href="{{route('auth.logout')}}">
                  <i class="fas fa-sign-out-alt"></i>
                  Logout</a>
              </div>
            </div>
            @endauth
          </div>
        </div>
      </div>
    </nav>

  </header>

  <style>
    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>