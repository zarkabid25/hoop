<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: center;">
        <div class="image" style="padding-left: 0">
            <img src="{{ asset('assets/img/logo/new-logo.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 8rem !important;">
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @php
                $dashboard = explode('.', request()->route()->getName());
                $userManagement = explode('.', request()->route()->getName());
                $order = explode('.', request()->route()->getName());
            @endphp
            <li class="nav-item menu-open">
                <a class="nav-link {{ ($dashboard[0] == 'dashboard') ? 'active' : '' }}" href="@if(auth()->user()->role == 'admin') {{ route('dashboard.admin') }} @elseif(auth()->user()->role == 'order') {{ route('dashboard.order') }} @elseif(auth()->user()->role == 'customer') {{ route('dashboard.customer') }} @elseif(auth()->user()->role == 'developer') {{ route('dashboard.developer') }} @elseif(auth()->user()->role == 'sales') {{ route('dashboard.sales') }} @endif">
                    <i class="nav-icon fas fa-tachometer-alt" style="color: #26DD38;"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            @if(auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->routeIs('user_management.create') || request()->routeIs('user_management.index')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-user-friends" style="color: lightskyblue"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if((request()->routeIs('user_management.create') || request()->routeIs('user_management.index'))) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('user_management.create') }}" class="nav-link {{ request()->routeIs('user_management.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user_management.index') }}" class="nav-link {{ request()->routeIs('user_management.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="nav-item {{ (request()->routeIs('order.index') || request()->routeIs('order.create')) ? 'menu-is-opening menu-open' : '' }}">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fas fa-briefcase" style="color: lightsalmon"></i>
                    <p>
                        Orders
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" @if((request()->routeIs('order.index') || request()->routeIs('order.create'))) style="display: block" @endif>
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link {{ request()->routeIs('order.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Orders</p>
                        </a>
                    </li>
                    @if(auth()->user()->role == 'customer' || auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('order.create') }}" class="nav-link {{ request()->routeIs('order.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Orders</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            @if(auth()->user()->role == 'customer' || auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->routeIs('quote.index') || request()->routeIs('quote.create')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ (request()->routeIs('quote.index') || request()->routeIs('quote.create')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen" style="color: khaki"></i>
                        <p>
                            Quotes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"  @if((request()->routeIs('quote.index') || request()->routeIs('quote.create'))) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('quote.index') }}" class="nav-link {{ request()->routeIs('quote.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Quotes</p>
                            </a>
                        </li>
                        @if(auth()->user()->role == 'customer')
                            <li class="nav-item">
                                <a href="{{ route('quote.create') }}" class="nav-link {{ request()->routeIs('quote.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Quote</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role == 'customer' || auth()->user()->role == 'sales')
                <li class="nav-item {{ (request()->routeIs('invoices')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('invoices') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt" style="color: violet"></i>
                        <p>
                            Invoices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(request()->routeIs('invoices')) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('invoices') }}" class="nav-link {{ request()->routeIs('invoices') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Invoices</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->routeIs('category.index')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-list-alt" style="color: violet"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->routeIs('product.index')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram" style="color: khaki"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role == 'sales')
                <li class="nav-item {{ (request()->routeIs('reward.index')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('reward.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gift" style="color: violet"></i>
                        <p>
                            Reward
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(request()->routeIs('reward.index')) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('reward.index') }}" class="nav-link {{ request()->routeIs('reward.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Rewards</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->routeIs('company-details-create')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('company-details-create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gift" style="color: violet"></i>
                        <p>
                            Company Details
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(request()->routeIs('company-details-create')) style="display: block" @endif>
                        <li class="nav-item">
                            <a href="{{ route('company-details-create') }}" class="nav-link {{ request()->routeIs('company-details-create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Details</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('company-details') }}" class="nav-link {{ request()->routeIs('company-details') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->role !== 'admin')
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link {{ (request()->routeIs('profile')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt" style="color: #4e90d3"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf

                    <button class="nav-link" type="submit" style="background-color: unset; border: none; text-align: left; color: #c2c7d0">
                        <i class="nav-icon fas fa-arrow-right"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
