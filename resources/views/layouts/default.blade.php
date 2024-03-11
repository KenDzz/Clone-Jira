<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <title> Task </title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Load Stile -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/min.css') }}">
    <link rel="stylesheet" href="{{ url('lib/notiflix/css/notiflix-3.2.6.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Meta SEO -->
    <meta name="keyword" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="canonical" href="" />
</head>

<body>
    @include('layouts.navbar')

    <!-- Start Main Content -->
    <section class="container-fluid no-padding">
        <div class="row wrapper no-padding">
            <div class="col-xl-1 col-sm-2">
                @include('layouts.menu')
            </div>
            <div class="col-xl-11 col-sm-10">
                @yield('content')
            </div>
        </div>
    </section>
    <!-- End Main Content-->


    <!-- Start Footer -->
    <footer>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/translations/es.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
    <script src="{{ url('lib/notiflix/js/notiflix-3.2.6.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="{{ url('js/module.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
