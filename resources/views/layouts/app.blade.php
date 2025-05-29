<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Daar es salam Al-islami</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/logo-drs.jpg') }}" />
    @include('include.style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
    <style>
        <style>
.custom-input-group {
  display: flex;
  align-items: center;
  border: 1px solid #ced4da;
  border-radius: 0.375rem;
  transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  padding-right: 0.5rem;
}

.custom-input-group:focus-within {
  border-color: #6366f1; /* indigo */
  box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
}

.custom-icon {
  background-color: #fff;
  padding: 0.5rem 0.75rem;
  border-right: 1px solid #ced4da;
  color: #333;
  display: flex;
  align-items: center;
  justify-content: center;
}

.custom-input {
  border: none;
  outline: none;
  flex-grow: 1;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  background-color: #fff;
}

.custom-input:focus {
  box-shadow: none;
}
</style>

    </style>
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
    @include('sweetalert::alert')
</body>

</html>
