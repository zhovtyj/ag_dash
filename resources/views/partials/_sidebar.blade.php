<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="{{ Request::is('/') ? 'active-menu' : '' }}" href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a class="{{ Request::is('services') ? 'active-menu' : '' }}" href="{{route('client.services')}}"><i class="fa fa-qrcode"></i> Services</a>
            </li>
            <li>
                <a href="chart.html"><i class="fa fa-bar-chart-o"></i> Charts</a>
            </li>
            <li>
                <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
            </li>

            <li>
                <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
            </li>
            <li>
                <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
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