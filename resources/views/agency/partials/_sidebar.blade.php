<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="{{ Request::is('/') ? 'active-menu' : '' }}" href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="{{ Request::is('client') ? 'active-menu' : '' }}" href="{{route('client.index')}}">
                    <i class="fa fa-users"></i>
                    Clients
                </a>
            </li>
            <li>
                <a class="{{ Request::is('orders') ? 'active-menu' : '' }}" href="{{route('order.index')}}"><i class="fa fa-edit"></i> Orders </a>
            </li>
            <li>
                <a class="{{ Request::is('deposit') ? 'active-menu' : '' }}" href="{{route('deposit.index')}}"><i class="glyphicon glyphicon-usd"></i> Deposit Funds</a>
            </li>

            <li>
                <a class="{{ Request::is('transactions') ? 'active-menu' : '' }}" href="{{route('transaction.index')}}"><i class="glyphicon glyphicon-transfer"></i> Transactions</a>
            </li>


            <li>
                <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Link</a>
                    </li>
                    <li>
                        <a href="#">Second Level Link</a>
                    </li>
                    <li>
                        <a href="#">Second Level Link<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>

                        </ul>

                    </li>
                </ul>
            </li>
            <li>
                <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
            </li>
        </ul>

    </div>

</nav>