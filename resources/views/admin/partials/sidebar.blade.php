<ul class="navbar-nav bg-gradient-primary sidebar sidebar-override sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <picture>
            <source media="(max-width: 767px)" srcset="{{asset('vendor/seumenu/img/logo-com-contorno-sem-nome.png')}}">
            <source media="(min-width: 768px)" srcset="{{asset('vendor/seumenu/img/logo-com-contorno.png')}}">
            <img src="{{asset('vendor/seumenu/img/logo-com-contorno.png')}}">
        </picture>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel de Controle</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-menu')}}">
            <i class="fab fa-fw fa-elementor"></i>
            <span>Menu</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-order-index')}}">
            <i class="fas fa-lg fa-money-bill"></i>
            <span>Pedidos</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-customer-index')}}">
            <i class="fas fa-lg fa-user"></i>
            <span>Clientes</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-payments')}}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Pagamento</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-delivery-points')}}">
            <i class="fas fa-fw fa-motorcycle"></i>
            <span>Entrega</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin-schedule-index')}}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Horários</span></a>
    </li>

    {{--<li class="nav-item">
        <a class="nav-link" href="{{route('admin-layout-index')}}">
            <i class="fas fa-lg fa-palette"></i>
            <span>Aparência</span></a>
    </li>--}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
