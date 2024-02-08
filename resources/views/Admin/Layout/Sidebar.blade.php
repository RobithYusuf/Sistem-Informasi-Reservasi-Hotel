<!-- Sidebar Menu -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-primary sidebar collapse">
    <div class="position-sticky pt-3">
        <!-- Dashboard and Home -->
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 ">
            <span>Dashboard</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : ''}}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

        </ul>
        <hr>

        <!-- Data Master -->
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 ">
            <span>Data Master</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('kamar*') ? 'active' : ''}}" href="/kamar">
                    <span data-feather="file-text"></span>
                    Room
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pesan*') ? 'active' : ''}}" href="/pesan">
                    <span data-feather="users"></span>
                    Customers
                </a>
            </li>
        </ul>
        <hr>

        <!-- Reservations and Transactions -->
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 ">
            <span>Transactions</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reservation*') ? 'active' : ''}}" href="/reservation">
                    <span data-feather="book-open"></span>
                    Reservation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reservasi-checkIn*') ? 'active' : '' }}" href="/reservasi-checkIn">
                    <span data-feather="log-in"></span>
                    Check In
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reservasi-checkOut*') ? 'active' : '' }}" href="/reservasi-checkOut">
                    <span data-feather="log-out"></span>
                    Check Out
                </a>
            </li>
        </ul>
        <hr>

        <!-- Reporting and Analytics -->
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 ">
            <span>Reporting</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('report*') ? 'active' : ''}}" href="/report">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
            </li>
        </ul>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('home') ? 'active' : ''}}" href="/home">
                    <span data-feather="arrow-left-circle"></span>
                    Homepage
                </a>
            </li>
        </ul>
    </div>
</nav>
