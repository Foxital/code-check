<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropify/dist/css/dropify.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link href="{{ asset('admin-assets/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet" />

    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin-assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('admin-assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin-assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin-assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin-assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin-assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote 
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>-->
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- select2 -->
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-lazy/jquery.lazyscript.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin-assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- summernote 
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Summernote 
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
-->
    <script src="{{ asset('admin-assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('admin-assets/tinymce/tinymce-codepen.min.css') }}">
    <script src="{{ asset('admin-assets/tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('admin-assets/tinymce/tinymce-theme.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/dist/js/adminlte.js') }}"></script>
    <style>
        .dropify-wrapper .dropify-message p {
            margin: 5px 0 0;
            font-size: 15px;
        }
        body {
            padding: 0;
        }
    </style>
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '.summernote',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help image code'
                ],
                toolbar1: 'undo redo | insert | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                fontsize_formats: "8pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 24pt 36pt",
                height: 300
            });
        });

    </script>

</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed">
    <div id="app" class="wrapper">
        @yield('content')
    </div>
</body>

</html>
