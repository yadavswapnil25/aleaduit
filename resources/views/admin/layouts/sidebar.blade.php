<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('dist/img/logo.svg') }}" alt="Invezza Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AleAudit</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{--  <a href="{{route('admin.profile.edit')}}"> <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"></a>  --}}
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user() ? Auth::user()->name : '' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (route('admin.dashboard') == URL::current()) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Always visible menu items -->
                @if (!request()->is('admin/client/*/master1') && !request()->is('admin/client/*/master2'))

                <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}"
                        class="nav-link @if (route('admin.clients.index') == URL::current()) active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Clients
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.audits.index') }}"
                        class="nav-link @if (route('admin.audits.index') == URL::current()) active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Audits
                        </p>
                    </a>
                </li>

                @endif
                <!-- Dynamically rendered side menu items -->
                @if (!empty($sideMenuItems))
                    @foreach ($sideMenuItems as $item)
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-menu-item" data-menu="{{ $item['name'] }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>{{ $item['name'] }}</p>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
