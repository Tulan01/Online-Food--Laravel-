
<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <title>Home</title>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />

   @include('layout.frontend.css')
  </head>

  <body>
    <!-- Container -->
    <div id="container">
      <!-- Header
        ================================================== -->
      <header class="clearfix trans">
         @include('layout.frontend.topbar')
      </header>
      <!-- End Header -->

      <!-- home-section 
      ================================================== -->
       @yield('contact')
      <!-- End contact section -->

      <!-- footer 
      ================================================== -->
     
      <!-- End footer -->
    </div>
    <!-- End Container -->
      @include('layout.frontend.jquery')
  </body>
</html>
