<!DOCTYPE html>
<html lang="en">

@include('admin.partials._head')

<body>

<div id="wrapper">
    @include('admin.partials._header')
    @include('admin.partials._sidebar')

    <div id="page-wrapper">
        <div id="page-inner">

            @yield('breadcrumbs')

            @yield('content')

            @include('admin.partials._footer')

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
@include('admin.partials._javascripts')
@yield('javascripts')

</body>
</html>