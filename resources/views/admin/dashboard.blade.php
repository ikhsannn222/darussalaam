<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Daar Es-Salam</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="{{ asset('assets/img//logo-drs.jpg') }}"/>
    @include("include.style")
  </head>

  <body>
    <!-- Sidebar -->
    @include('include.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
      {{-- header --}}
      @include('include.header')
      {{-- end header --}}

      {{-- content --}}
      @yield('content')
      {{-- end content --}}

      {{-- footer --}}
      @include('include.footer')
      {{-- end footer --}}
    @include('include.script')
  </body>
</html>
