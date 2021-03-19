<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mohammed Mojaly">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="adminId" content="{{ auth()->check() ? auth()->id() : ''}}">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>


    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">

    @yield('style')
    @livewireStyles

</head>
<body id="page-top">
    <div id="app">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('partial.backend.sidbar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        @include('partial.backend.header')
        <!-- Main Content -->
        <div id="content">

            <div class="container-fluid">


                @include('partial.flash')
                @yield('content')
                <!-- Page Heading -->


            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; {{config('app.name')}}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

<!-- End of Page Wrapper -->

</div>
<!-- End of Content Wrapper -->



</div>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">






    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{ asset('backend/js/custom.js') }}"></script>


    @yield('script')
    @livewireScripts
    @stack('scripts')

</body>
</html>
