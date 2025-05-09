<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <div class="row">
        <div class="col-3">
            <a class="dropdown-item" style="width: 60%" target="_blank" href="{{'http://'.env('MENU_DOMAIN')}}">
                Visualizar Menu
                <i class="fas fa-external-link-alt fa-lg fa-fw mr-2 text-gray-800"></i>
            </a>
        </div>
        <div class="col-4">
            <form id="form-update-minimal-order">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Pedido mínimo</div>
                    </div>
                    <input type="text" id="minimal_order" name="minimal_order" value="{{number_format(floatval($settings->minimal_order), 2, ',', '.')}}" placeholder="0,00" class="form-control">
                    <div class="input-group-append">
                        <button type="button" id="update-minimal-order" class="btn btn-primary btn-user">
                            Redefinir
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <div class="col-5">
            <form id="form-update-prevision">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Previsão de entrega hh:mm</div>
                    </div>
                    <input type="text" id="prevision" name="prevision" value="{{$settings->delivery_prevision}}" placeholder="00:00" class="form-control">
                    <div class="input-group-append">
                        <button type="button" id="update-prevision" class="btn btn-primary btn-user">
                            Redefinir
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw fa-2x"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" style="width: 25px; height: 25px; font-size: 16px">0</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" id="alertsDropdownContent"  aria-labelledby="alertsDropdown">
                <a class="dropdown-header text-center" href="#">
                   Exibir todos os pedidos
                </a>

            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($settings)
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$settings->name}}</span>
                @else
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$user->name}}</span>
                @endif
                @if($settings)
                <img class="img-profile rounded-circle" src="{{$settings->logo}}">
                @else
                <img class="img-profile rounded-circle" src="{{ Gravatar::src($user->email) }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Sair
                </a>
            </div>
        </li>

    </ul>

</nav>
