<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="{{ Request::is('admin') ? 'active-menu' : '' }}" href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/service') ? 'active-menu' : '' }}" href="#"><i class="fa fa-sitemap"></i> Services<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('service.index')}}"> All Services</a>
                    </li>
                    <li>
                        <a href="{{route('service-optional.index')}}"> Optional Services</a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}"> Categories</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ Request::is('admin/agency') ? 'active-menu' : '' }}" href="{{ route('admin.user') }}"><i class="fa fa-users"></i> Agency</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/orders/all') ? 'active-menu' : '' }}" href="{{ route('admin.orders.all') }}"><i class="fa fa-edit"></i> Orders <span id="orders-count"></span></a>
            </li>
            <li>
                <a class="{{ Request::is('admin/messages/all') ? 'active-menu' : '' }}" href="{{ route('admin.messages.threads') }}"><i class="fa fa-envelope fa-fw"></i> Messages <small id="new-messages-count"></small></a>
            </li>

        </ul>

    </div>

</nav>