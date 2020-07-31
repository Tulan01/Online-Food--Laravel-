<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ADMIN</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />

        @include('layout.backend.css')
    </head>

    <body>

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        @yield('contact')

        <!-- END wrapper -->
            

        <!-- jQuery  -->
        @include('layout.backend.jquery')

    </body>

</html>