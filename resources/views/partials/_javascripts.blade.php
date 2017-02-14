<!-- Jquery Js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Bootstrap Js -->
<script src="/admin-assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="/admin-assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
{{--<script src="/admin-assets/js/morris/raphael-2.1.0.min.js"></script>--}}
{{--<script src="/admin-assets/js/morris/morris.js"></script>--}}
{{--<!--Custom Js -->--}}
{{--<script src="/admin-assets/js/custom-scripts.js"></script>--}}
<script>
    $('#main-menu').metisMenu();

    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    });
</script>
@yield('javascript')