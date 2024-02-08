<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Family Inn Hotel</a>

  <button class="navbar-toggler position-absolute d-md-none collapsed bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->

  <div class="navbar-nav bg-dark">
    <div class="nav-item text-nowrap">
        <form action="{{ url('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link px-3" style="background-color: transparent; border: 0px">Logout
            <span data-feather="log-out"></span>
            </button>
        </form>
    </div>
  </div>
</header>
