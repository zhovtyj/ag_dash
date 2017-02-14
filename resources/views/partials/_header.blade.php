<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
    </div>

    @if (Auth::user())
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.Cart -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span id="cart-count-container">
                    @if(isset($cart))
                        (<span id="cart-count">{{$cart->count()}}</span>)
                        <i class="fa fa-caret-down"></i>
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu dropdown-alerts" id="cart-items-container">
            @if(isset($cart) && $cart->count() > 0)
                @foreach($cart as $cart_item)
                    <li>
                        <a href="{{ route('client.services.show', $cart_item->service->id) }}">
                            <div>
                                <i class="glyphicon glyphicon-check"></i> {{$cart_item->service->name}}
                                <span class="pull-right text-muted small">{{$cart_item->service->price}}$</span>
                            </div>
                        </a>
                    </li>
                @endforeach
                <li class="divider append-before"></li>
                <li>
                    <a href="{{route('cart.index')}}">
                        <div>
                            <i class="glyphicon glyphicon-arrow-right"></i> Go to the cart
                        </div>
                    </a>
                </li>
            @else
                <li class="divider append-before link-to-cart"></li>
                <li class="link-to-cart">
                    <a href="#">
                        <div>
                            <i class="glyphicon glyphicon-arrow-right"></i> Go to the cart
                        </div>
                    </a>
                </li>
                <li class="cart-empty">
                    <a href="#">
                        <div>
                            <i class="glyphicon glyphicon-check"></i> Cart is empty
                        </div>
                    </a>
                </li>
            @endif
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                @if ((Session::has('success')) || (count($errors)>0))
                    1
                @endif
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                @if (Session::has('success'))
                    <li>
                        <a href="#">
                            <div>
                                <strong>Success:</strong>
                                <span class="pull-right text-muted">
                                    <em>Today</em>
                                </span>
                            </div>
                            <div>{{ Session::get('success') }}</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                @endif

                @if (count($errors)>0)
                    <li>
                        <a href="#">
                            <div>
                                <strong>Errors:</strong>
                                <span class="pull-right text-muted">
                                    <em>Today</em>
                                </span>
                            </div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </a>
                    </li>
                    <li class="divider"></li>
                @endif
                <li>
                    <a class="text-center" href="#">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"> </span> Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    @endif
</nav>