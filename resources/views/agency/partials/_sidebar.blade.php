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
                <a class="{{ Request::is('messages') ? 'active-menu' : '' }}" href="{{route('messages.index')}}"><i class="glyphicon glyphicon-flash"></i> Support <small id="new-messages-count"></small></a>
            </li>

        </ul>
    </div>
</nav>