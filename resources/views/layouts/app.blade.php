<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Scale Auto & Air')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
</head>

<body class="bg-light">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark px-4">
    <img src="{{ asset('img/logo.png') }}" alt="" style="width: 50px">
    <a class="navbar-brand text-white" href="/">Scale Auto & Air</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-white" href="{{route('home.index')}}">{{__('navNames.home')}}</a>
        </li>
        <li class="nav-item"><a class="nav-link text-white" href="{{route('product.index')}}">{{__('navNames.products')}}</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{route('wish_items.index')}}">{{__('navNames.wish_items')}}</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{route('cart.index')}}">{{__('navNames.cart')}}</a></li>
        <div class="vr bg-white mx-2 d-none d-lg-block"></div>
        @guest
        
        <a class="nav-link active" href="{{route('login')}}">{{__('navNames.login')}}</a>
        <a class="nav-link active" href="{{route('register')}}">{{__('navNames.register')}}</a>
        @else
        <form id="logout" action="{{route('logout')}}" method="POST">
          <a role="button" class="nav-link active"
            onclick="document.getElementById('logout').submit();">{{__('navNames.logout')}}</a>
          @csrf
        </form>
        @if(Auth::user()->is_admin)
        <a class="nav-link active" href="{{route('admin.home')}}">{{__('navNames.admin')}}</a>
        @endif
        @endguest
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-4">
    @yield('content')
  </div>

  <!-- Footer -->
  <footer class="footer text-white text-center p-3 mt-4">
    <p>&copy; {{ date('Y') }} {{__('messages.footer')}}</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>