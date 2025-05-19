{{-- CSS --}}
<!-- Tambahkan CSS layout -->
    <style>
      html, body {
        height: 100%;
        margin: 0;
      }

      .main-panel {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }

      .main-panel .content {
        flex: 1;
      }

      footer {
        margin-top: auto;
      }
    </style>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
