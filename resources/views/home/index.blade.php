@extends('layouts.app')

@section('content')
<div class="container-fluid vh-100 d-flex">
  <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
    <img src="{{ asset('img/logoText.png') }}" alt="Logo de Scaled Hangar" class="img-fluid" style="max-height: 300px;">
  </div>

  <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
    <h1 class="mb-4">{{__('home.welcome')}}</h1>

    <form method="GET" action="{{ route('home.index') }}" class="mb-4 w-100">
      <div class="d-flex align-items-center flex-wrap">
        <label class="form-label me-3">{{__('home.weather_provider')}}</label>
        <select name="weatherProvider" class="form-select w-auto me-3" onchange="this.form.submit()">
          <option value="static" {{ request('weatherProvider') === 'static' ? 'selected' : '' }}>{{__('home.static')}}</option>
          <option value="api" {{ request('weatherProvider') === 'api' ? 'selected' : '' }}>{{__('home.api')}}</option>
        </select>
        <div class="fs-5 mt-2 mt-md-0">
          {{__('home.temperature_medellin')}} <strong>{{ $viewData['temperature'] }} °C</strong>
        </div>
      </div>
    </form>
    <h5 class="mt-4 mb-3 fw-semibold">{{__('home.some_products')}}</h5>
    <div id="productsCarousel" class="carousel slide w-100 position-relative" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($viewData['mostSoldProducts']->chunk(2) as $chunkIndex => $chunk)
        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
          <div class="row">
            @foreach($chunk as $product)
            <div class="col-md-6">
              <div class="card mb-3">
                <a href="{{ route('product.show', ['id' => $product->getId()])}}" style="text-decoration: none; color: inherit;">
                  <img src="{{ asset($product->getImagePath()) }}" class="card-img-top" alt="Imagen del producto">
                  <div class="card-body">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text">Precio: ${{ $product->getPrice() }}</p>
                  </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>

      <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">{{__('home.previous')}}</span>
      </button>
      <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
        <span class="visually-hidden">{{__('home.next')}}</span>
      </button>
    </div>
  </div>
</div>
@endsection