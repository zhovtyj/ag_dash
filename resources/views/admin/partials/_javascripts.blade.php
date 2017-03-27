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

    //LISTEN FOR NEW MESSAGE
    var timeout = 1;
    function newMessages(){
        $.ajax({
            url: '{{route('admin.messages.count')}}',
            type:'post',
            data:{timeout:timeout,_token:'{{ csrf_token() }}'},
            success: function(data){
                if(data.count > 0){
                    $('#new-messages-count').text('('+data.count+' new messages)');
                    $('#header-message-count').text(data.count);

                    $('#dropdown-messages').html('' +
                        '<li style="padding:5px 10px;">' +
                        '<div><strong>New Message:</strong></div>' +
                        '<a class="new-message" href="/admin/messages/'+data.message.user_id+'">' +
                        '<strong>'+data.message.message+'</strong>' +
                        '<div><small><span class="glyphicon glyphicon-time"></span>'+data.message.created_at+'</small></div>' +
                        '</a>' +
                        '</li>');
                };
                timeout = timeout+1;
                setTimeout( newMessages(), 10000);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    newMessages();

    //LISTEN FOR NEW ORDERS
    function newOrders(){
        $.ajax({
            url: '{{route('admin.orders.count')}}',
            type:'post',
            data:{timeout:timeout,_token:'{{ csrf_token() }}'},
            success: function(data){
                if(data.count > 0){
                    $('#orders-count').html('<small>('+data.count+' New Orders)</small>');
                };
                timeout = timeout+1;
                setTimeout( newOrders(), 10000);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    newOrders();

    //LISTEN FOR NEW SUBSCRIPTIONS
    function newSubscriptions(){
        $.ajax({
            url: '{{route('admin.subscriptions.count')}}',
            type:'post',
            data:{timeout:timeout,_token:'{{ csrf_token() }}'},
            success: function(data){
                if(data.count > 0){
                    $('#subscriptions-count').html('<small>('+data.count+' New Subscriptions)</small>');
                };
                timeout = timeout+1;
                setTimeout( newSubscriptions(), 10000);
            },
            error: function(data){
                console.log(data);
            }
        });
    }

    newSubscriptions();

</script>

@yield('javascript')