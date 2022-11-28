<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>
    </head>
    <body>
        <div id="app">
            <header>
                <div class="px-3 py-2 text-bg-dark">
                    <div class="container">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                            <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                            </a>

                            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                                <li>
                                    <a href="#" class="nav-link text-secondary">
                                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link text-white">
                                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"></use></svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link text-white">
                                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"></use></svg>
                                        Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link text-white">
                                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"></use></svg>
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link text-white">
                                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"></use></svg>
                                        Customers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    </body>
</html>
