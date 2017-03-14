<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>﻿
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
    (function ($) {
        "use strict";
        var mainApp = {

            initFunction: function () {
                /*MENU
                 ------------------------------------*/
                $('#main-menu').metisMenu();

                $(window).bind("load resize", function () {
                    if ($(this).width() < 768) {
                        $('div.sidebar-collapse').addClass('collapse')
                    } else {
                        $('div.sidebar-collapse').removeClass('collapse')
                    }
                });
            },

            initialization: function () {
                mainApp.initFunction();

            }
        }
        // Initializing ///

        $(document).ready(function () {
            mainApp.initFunction();
        });

    }(jQuery));


    //Listen for new Messages
    newMessages();
    setInterval( newMessages(), 10000);

    function newMessages(){
        $.ajax({
            url: '{{route('messages.count')}}',
            type:'post',
            data:{_token:'{{ csrf_token() }}'},
            success: function(data){
                $('#new-messages-count').text('('+data+' unread messages)')
            },
            error: function(data){
                console.log(data);
            }
        });
    };

</script>

@yield('javascript')