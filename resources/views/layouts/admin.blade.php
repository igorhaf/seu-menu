
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel Administrativo</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- One of the following themes -->
    <link href="{{asset('vendor/seumenu/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/pickr/themes/nano.min.css')}}"/>
    <link href="{{asset('vendor/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/seumenu/css/jquery.timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/seumenu/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/seumenu/css/jquery-confirm.min.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('vendor/seumenu/img/page/favicon.png')}}"/>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.partials.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.partials.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@yield('modals')

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.mask.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/pickr/pickr.es5.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/caleandar.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/sb-admin-2.js')}}"></script>
<script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/jquery-mask-money/jquery.maskMoney.js')}}"></script>
<script src="{{asset('vendor/seumenu/js/bootstrap4-toggle.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@1.16.3/src/bootstrap-input-spinner.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        $(function() {
           $("#minimal_order").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
        })
        $('#prevision').mask('00:00');
    });

    $('#update-prevision').click(function(){
        let prevision = $('#form-update-prevision').serialize();
        $.post("{{route('admin-dashboard-update-prevision')}}", prevision, function(data) {
            $.alert({
                title: 'Previsão alterada',
                content: 'A nova previsão de entrega agora é: '+$('#prevision').val(),
            });
            return false;
        })
    })
    $('#update-minimal-order').click(function(){
        let minimal_order = $('#form-update-minimal-order').serialize();
        $.post("{{route('admin-dashboard-update-minimal-order')}}", minimal_order, function(data) {
            $.alert({
                title: 'Pedido mínimo alterado',
                content: 'O novo pedido mínimo agora é: '+$('#minimal_order').val(),
            });
            return false;
        })
    })

    $('.viewOrderModalPendding').click(function (){
        let order_id = $(this).data('order-id')
        $.get("{{route('admin-order-show')}}/"+order_id, function(data) {
            $('#modalOrderPendding').html(data);
            $('#accept_order').attr('href', "{{route('admin-order-accepted')}}/"+order_id)
            $('#reject_order').attr('href', "{{route('admin-order-rejected')}}/"+order_id)
        })
    })
    $('.viewOrderModalAccepted').click(function (){
        let order_id = $(this).data('order-id')
        $.get("{{route('admin-order-show')}}/"+order_id, function(data) {
            $('#modalOrderAccepted').html(data);
            $('#sent_order').attr('href', "{{route('admin-order-sent')}}/"+order_id)
        })
    })
    $('.viewOrderModalSent').click(function (){
        let order_id = $(this).data('order-id')
        $.get("{{route('admin-order-show')}}/"+order_id, function(data) {
            $('#modalOrderSent').html(data);
            $('#done_order').attr('href', "{{route('admin-order-sent')}}/"+order_id)
        })
    })
    $('.viewOrderModalDone').click(function (){
        let order_id = $(this).data('order-id')
        $.get("{{route('admin-order-show')}}/"+order_id, function(data) {
            $('#modalOrderDone').html(data);
        })
    })
    // request permission on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (!Notification) {
            console.log('Desktop notifications not available in your browser. Try Chromium.');
            return;
        }

        if (Notification.permission !== 'granted')
            Notification.requestPermission();
    });




    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dc48f15780a4a7d518eb', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('new-order');
    channel.bind('new-order', function(data) {
        $('#alertsDropdown > span').html(parseInt($('#alertsDropdown > span').html(), 10)+1)
        let order_date = moment(data['order_date']);

        $('#alertsDropdownContent').append('<a class="dropdown-item d-flex align-items-center" href="#">\n' +
            '                    <div class="mr-3">\n' +
            '                        <div class="icon-circle bg-primary">\n' +
            '                            <i class="fas fa-file-alt text-white"></i>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div>\n' +
            '                        <div class="small text-gray-500">'+order_date.format('DD/MM//YYYY HH:mm:ss')+'</div>\n' +
            '                        <span class="font-weight-bold">'+data['customer_name']+'</span>\n' +
            '                    </div>\n' +
            '                </a>')
        $('#order_data').prepend('<tr>\n' +
'                                    <td>'+data['customer_name']+'</a></td>\n' +
'                                    <td>'+data['customer_cellphone']+'</td>\n' +
'                                    <td>'+data['customer_street']+'</td>\n' +
'                                    <td>'+order_date.format('DD/MM//YYYY HH:mm:ss')+'</td>\n' +
'                                    <td style="text-align: center"><button class="btn btn-primary viewOrderModal" data-toggle="modal" data-order-id="'+data['order_id']+'" data-target="#viewOrderModal">Visualizar</button></td>\n' +
'                                </tr>')
        if (Notification.permission !== 'granted')
            Notification.requestPermission();
        else {
            var notification = new Notification('Novo Pedido', {
                icon: '{{asset('/img/logo-pisu.jpg')}}',
                body: data['order_date']+' '+data['customer_name'],
            });
            notification.onclick = function() {
                window.open("{{route('admin-order-index')}}");
            };
        }
    });
</script>

<script>
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar-brand').html("<img src=\"{{asset('vendor/seumenu/img/logo-com-contorno-sem-nome.png')}}\">");
        }else{
            $('.sidebar-brand').html(" <picture>\n" +
                "            <source media=\"(max-width: 767px)\" srcset=\"{{asset('vendor/seumenu/img/logo-com-contorno-sem-nome.png')}}\">\n" +
                "            <source media=\"(min-width: 768px)\" srcset=\"{{asset('vendor/seumenu/img/logo-com-contorno.png')}}\">\n" +
                "            <img src=\"{{asset('vendor/seumenu/img/logo-com-contorno.png')}}\">\n" +
                "        </picture>");
        };
    });
</script>
@yield('javascript')

</body>

</html>
