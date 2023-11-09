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


                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">BUSINESS</span>
                </li>
                @can('author-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('authors.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Authors</span>
                        </a>
                    </li>
                @endcan

                @can('category-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('categories.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-category"></i>
                            </span>
                            <span class="hide-menu">Categories</span>
                        </a>
                    </li>
                @endcan

                @can('multimedia-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('multimedias.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-photo"></i>
                            </span>
                            <span class="hide-menu">Multimedias</span>
                        </a>
                    </li>
                @endcan

                @can('gallery-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('galleries.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-photo"></i>
                            </span>
                            <span class="hide-menu">Galleries</span>
                        </a>
                    </li>
                @endcan

                @can('news-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('news.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-message"></i>
                            </span>
                            <span class="hide-menu">News</span>
                        </a>
                    </li>
                @endcan

                @can('comment-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('comments.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Coments</span>
                        </a>
                    </li>
                @endcan

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
