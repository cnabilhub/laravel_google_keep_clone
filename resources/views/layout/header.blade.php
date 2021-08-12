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
    <nav class="navbar navbar-expand-lg  bg-white text-black">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{asset('/images/logo.png  ')}}" alt="" srcset="" class="header-logo">
          <span class="header-text">
            Google Keep
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('create_note')}}">Add Note</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('categories')}}">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('tags')}}">Tags</a>
            </li>

          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-warning" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>