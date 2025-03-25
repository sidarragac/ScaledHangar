<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand text-white" href="{{ route('admin.home') }}">{{ __('navNames.menu_admin') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home.index') }}">{{ __('navNames.home') }}</a>
                </li>
                <li class="nav-item">
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active"
                            onclick="document.getElementById('logout').submit();">{{ __('navNames.logout') }}</a>
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
            <h5 class="text-center">{{ __('navNames.menu_admin') }}</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.category.index') }}">{{ __('navNames.category') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.product.index') }}">{{ __('navNames.products') }}</a>
                </li>
            </ul>
        </div>

        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
