 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-store"></i>
    </div>
    <div class="sidebar-brand-text mx-2">Alisha<sub> Laundry</sub></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-user-friends "></i>
        <span>Data Pengguna</span>
    </a>
</li>




<!-- Divider -->
<hr class="sidebar-divider">


<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
    <a class="nav-link" href="{{route('customer.index')}}">
        <i class="fas fa-fw fa-user"></i>
        <span>Pelanggan</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('packet.index')}}">
        <i class="fas fa-fw fa-tablets"></i>
        <span>Paket</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('promo.index')}}">
        <i class="fas fa-fw fa-magnet"></i>
        <span>Promo</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('order.index')}}">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>Order</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-book"></i>
        <span>Laporan Order</span></a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{route('devices.index')}}">
        <i class="fas fa-fw fa-check "></i>
        <span>Tautan WA</span>
    </a>
</li>


<!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-money-bill-wave-alt"></i>
        <span>Pengeluaran</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-book"></i>
        <span>Laporan</span></a>
</li> -->





<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->