<!DOCTYPE html>
<html lang="en">

@include('agency.partials._head')

<body>

<div id="wrapper">
    @include('agency.partials._header')
    @include('agency.partials._sidebar')

    <div id="page-wrapper">
        <div id="page-inner">

            @yield('breadcrumbs')

            @yield('content')

            @include('agency.partials._footer')

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
@yield('javascript')

</body>
</html>


