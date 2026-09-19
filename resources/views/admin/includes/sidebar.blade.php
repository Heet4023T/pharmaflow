<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">

        <!-- Brand Logo -->
        <div class="sidebar-logo">
            <div class="brand-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V21C3 22.1 3.9 23 5 23H19C20.1 23 21 22.1 21 21V5C21 3.9 20.1 3 19 3ZM12 3C12.55 3 13 3.45 13 4C13 4.55 12.55 5 12 5C11.45 5 11 4.55 11 4C11 3.45 11.45 3 12 3ZM13 17H11V15H9V13H11V11H13V13H15V15H13V17ZM19 21H5V5H7V7H17V5H19V21Z" fill="white"/>
                </svg>
            </div>
            <span class="brand-name">PharmaFlow</span>
        </div>

        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="menu-title"><span>Main</span></li>
                <li class="{{ route_is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Inventory -->
                @canany(['view-category','view-products'])
                <li class="menu-title"><span>Inventory</span></li>
                @endcanany

                @can('view-category')
                <li class="{{ route_is('categories.*') ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                @endcan

                @can('view-products')
                <li class="submenu {{ route_is('products.*') || route_is('outstock') || route_is('expired') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-pills"></i>
                        <span>Products</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('products.*') || route_is('outstock') || route_is('expired') ? 'display:block;' : 'display: none;' }}">
                        <li><a class="{{ route_is('products.index') ? 'active' : '' }}" href="{{route('products.index')}}">All Products</a></li>
                        @can('create-product')
                        <li><a class="{{ route_is('products.create') ? 'active' : '' }}" href="{{route('products.create')}}">Add Product</a></li>
                        @endcan
                        @can('view-outstock-products')
                        <li><a class="{{ route_is('outstock') ? 'active' : '' }}" href="{{route('outstock')}}">Out of Stock</a></li>
                        @endcan
                        @can('view-expired-products')
                        <li><a class="{{ route_is('expired') ? 'active' : '' }}" href="{{route('expired')}}">Expired</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Purchasing -->
                @canany(['view-purchase','view-supplier'])
                <li class="menu-title"><span>Purchasing</span></li>
                @endcanany

                @can('view-purchase')
                <li class="submenu {{ route_is('purchases.*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-cart-plus"></i>
                        <span>Purchases</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('purchases.*') ? 'display:block;' : 'display: none;' }}">
                        <li><a class="{{ route_is('purchases.index') ? 'active' : '' }}" href="{{route('purchases.index')}}">All Purchases</a></li>
                        @can('create-purchase')
                        <li><a class="{{ route_is('purchases.create') ? 'active' : '' }}" href="{{route('purchases.create')}}">Add Purchase</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('view-supplier')
                <li class="submenu {{ route_is('suppliers.*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-truck"></i>
                        <span>Suppliers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('suppliers.*') ? 'display:block;' : 'display: none;' }}">
                        <li><a class="{{ route_is('suppliers.index') ? 'active' : '' }}" href="{{route('suppliers.index')}}">All Suppliers</a></li>
                        @can('create-supplier')
                        <li><a class="{{ route_is('suppliers.create') ? 'active' : '' }}" href="{{route('suppliers.create')}}">Add Supplier</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Sales -->
                @can('view-sales')
                <li class="menu-title"><span>Sales</span></li>
                <li class="submenu {{ route_is('sales.*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-receipt"></i>
                        <span>Sales</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('sales.*') ? 'display:block;' : 'display: none;' }}">
                        <li><a class="{{ route_is('sales.index') ? 'active' : '' }}" href="{{route('sales.index')}}">All Sales</a></li>
                        @can('create-sale')
                        <li><a class="{{ route_is('sales.create') ? 'active' : '' }}" href="{{route('sales.create')}}">Add Sale</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Reports -->
                @can('view-reports')
                <li class="menu-title"><span>Analytics</span></li>
                <li class="submenu {{ route_is('sales.report') || route_is('purchases.report') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('sales.report') || route_is('purchases.report') ? 'display:block;' : 'display: none;' }}">
                        <li><a class="{{ route_is('sales.report') ? 'active' : '' }}" href="{{route('sales.report')}}">Sales Report</a></li>
                        <li><a class="{{ route_is('purchases.report') ? 'active' : '' }}" href="{{route('purchases.report')}}">Purchase Report</a></li>
                    </ul>
                </li>
                @endcan

                <!-- Admin -->
                @canany(['view-access-control','view-users'])
                <li class="menu-title"><span>Administration</span></li>
                @endcanany

                @can('view-access-control')
                <li class="submenu {{ route_is('roles.*') || route_is('permissions.*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-shield-alt"></i>
                        <span>Access Control</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ route_is('roles.*') || route_is('permissions.*') ? 'display:block;' : 'display: none;' }}">
                        @can('view-permission')
                        <li><a class="{{ route_is('permissions.*') ? 'active' : '' }}" href="{{route('permissions.index')}}">Permissions</a></li>
                        @endcan
                        @can('view-role')
                        <li><a class="{{ route_is('roles.*') ? 'active' : '' }}" href="{{route('roles.index')}}">Roles</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('view-users')
                <li class="{{ route_is('users.*') ? 'active' : '' }}">
                    <a href="{{route('users.index')}}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                @endcan

                <!-- System -->
                <li class="menu-title"><span>System</span></li>

                <li class="{{ route_is('profile') ? 'active' : '' }}">
                    <a href="{{route('profile')}}">
                        <i class="fas fa-user-circle"></i>
                        <span>My Profile</span>
                    </a>
                </li>

                <li class="{{ route_is('backup.index') ? 'active' : '' }}">
                    <a href="{{route('backup.index')}}">
                        <i class="fas fa-database"></i>
                        <span>Backups</span>
                    </a>
                </li>

                @can('view-settings')
                <li class="{{ route_is('settings') ? 'active' : '' }}">
                    <a href="{{route('settings')}}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->