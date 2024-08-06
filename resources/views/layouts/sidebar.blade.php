 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-store"></i>
    </div>
    <div class="sidebar-brand-text mx-2">Alisha<sub> Laundry</sub></div>
</a>


<hr class="sidebar-divider my-0">

<li class="nav-item ">
    <a class="nav-link" href="{{route('dashboard.index')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<hr class="sidebar-divider">

@if (Auth::user()->role == 'owner')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-fw fa-user-friends"></i>
                <span>Data Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('packet.index') }}">
                <i class="fas fa-fw fa-tablets"></i>
                <span>Data Paket</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.owner.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pelanggan</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.owner.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Data Order</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan Order</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('devices.owner.index') }}">
            <i class="fas fa-fw fa-check"></i>
            <span>Tautan WA</span>
        </a>
    </li>

  
  
    @elseif (Auth::user()->role == 'pegawai')

    <li class="nav-item">
            <a class="nav-link" href="{{ route('packet.pegawai.index') }}">
                <i class="fas fa-fw fa-tablets"></i>
                <span>Data Paket</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pelanggan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Data Order</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('devices.pegawai.index') }}">
            <i class="fas fa-fw fa-check"></i>
            <span>Tautan WA</span>
        </a>
    </li>


    @endif


<hr class="sidebar-divider d-none d-md-block">
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
