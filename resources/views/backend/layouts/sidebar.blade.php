<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img">
                <img src="{{ url('assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if (true)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">BUSINESS</span>
                    </li>
                    @can('client-list')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('clients.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Clients</span>
                            </a>
                        </li>
                    @endcan
                @endif

                @if (Auth::user()->can('user-list') || Auth::user()->can('role-list'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">SECURITY</span>
                    </li>
                    @can('user-list')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-cog"></i>
                                </span>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                    @endcan
                    @can('role-list')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shield-lock"></i>
                                </span>
                                <span class="hide-menu">Roles</span>
                            </a>
                        </li>
                    @endcan
                @endif


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
