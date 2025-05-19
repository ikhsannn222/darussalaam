<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Daar es salam Al-islami</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/logo-drs.jpg') }}" />
    @include('include.style')
</head>

<body>
    <div class="wrapper">
        @include('include.sidebar') <!-- Sidebar -->

        <div class="main-panel">
            @include('include.header') <!-- Header -->

            <div class="content" style="padding-top: 70px;">
                @yield('content')
            </div>


            @include('include.footer') <!-- Footer -->
        </div>
    </div>
    @include('include.script') <!-- Script -->
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

</body>

</html>
