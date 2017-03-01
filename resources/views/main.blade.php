<!DOCTYPE html>
<html lang="en">

@include('partials._head')

<body>

@include('partials._header')

<div class="login-page-container">

    @yield('content')

    @include('partials._footer')

    @include('partials._javascripts')

    @yield('javascripts')

</div>

</body>
</html>


