<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">

        <meta name="viewport"
              content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token"
              content="{{ csrf_token() }}">

        <title>@yield('title', 'FALGUN')</title>

        <meta name="description"
              content="@yield('meta_description', 'FALGUN Premium Ready-Made Garments Manufacturer from Bangladesh')">

        <meta name="keywords"
              content="@yield('meta_keywords', 'garments, apparel, fashion, manufacturer, Bangladesh, knitwear, woven, denim')">

        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect"
              href="https://fonts.gstatic.com"
              crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
              rel="stylesheet">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
              rel="stylesheet">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              rel="stylesheet">

        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css"
              rel="stylesheet">


        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
              rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @include('sweetalert::alert')


        @yield('top')


    </head>

    <body>
        <main>
            <!-- Check if it's a standard view or a Breeze component slot -->
            @if(isset($slot))
            <div class="container my-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="w-100 style-card bg-white p-4 rounded-4 shadow-sm border border-light" style="max-width: 450px;">
                    <h1 class="text-center text-uppercase fw-bold">FALGUN</h1>
                    {{ $slot }}
                </div>
            </div>
            @else
            @yield('content')
            @include('layouts.partials.footer')
            @endif
        </main>






        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

        <script>

AOS.init({
    duration: 900,
    once: true
});

        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        @yield('scripts')
    </body>
</html>
