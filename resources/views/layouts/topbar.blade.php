 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>



<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-paper-plane fa-fw"></i>
            <span class="badge badge-danger badge-counter">+1</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Sent message status
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-info">
                        <i class="fas fa-paper-plane text-white"></i>
                    </div>
                </div>
                <div>
                     <div class="small text-gray-500"></div>
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">View all</a>
        </div>
    </li>


    <div class="topbar-divider d-none d-sm-block"></div>
     
    <li class="nav-item mx-1">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link" id="logoutButton" role="button">
            <i class="fas fa-sign-out-alt fa-fw"></i>
            Logout
        </button>
    </form>
</li>


</ul>

</nav>


<!-- End of Topbar -->