<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('Title', 'Dashboard')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ url('/img/logo2.png') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/LayoutAdmin.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/AdminKamar.css') }}" rel="stylesheet">

    @stack('linkstyle')


</head>

<body>
    @include('Admin.Layout.Navbar')
    <div class="container-fluid">
        <div class="row">
            @include('Admin.Layout.Sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('admin-konten')
            </main>
        </div>
    </div>
    @include('Admin.Layout.Footer')
    @stack('script')
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
    <!-- <script src="{{ asset('js/siderbars.js') }}"></script> -->
    <script>
        "use strict";
        feather.replace({
            "aria-hidden": "true"
        });
    </script>

</body>

</html>
