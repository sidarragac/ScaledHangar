@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')
<center>
  <h1>{{ __('cart.title_site') }}</h1>
</center>
@if($viewData['msg'])
<div class="alert alert-success">{{ $viewData['msg'] }}</div>
@endif
@if(count($viewData["products"]) === 0)
<div class="alert alert-warning" role="alert">
  {{ __('cart.no_products') }}
</div>
@else
<div class="row d-flex justify-content-center align-items-md-start align-items-center flex-md-row flex-column">
  <div class="card px-0" style="width: 18rem;">
    <div class="card-header">
      {{ __('cart.cart_info') }}
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">{{ __('cart.product') }} {{ $viewData['totalProducts'] }}</li>
      <li class="list-group-item">{{ __('cart.price') }} ${{ $viewData['totalPrice'] }}</li>
    </ul>
    <div class="card-body text-center">
      <a href="{{ route('cart.checkout') }}" class="btn bg-primary text-white card-link">
        {{ __('cart.checkout') }}
      </a>
      <a href="{{ route('cart.clear') }}" class="btn bg-danger text-white card-link" role="alert">
        {{ __('cart.clear') }}
      </a>
    </div>
  </div>

  <div class="col-9">

    <div class="d-flex flex-row flex-wrap justify-content-center justify-content-md-start gap-3">
      @foreach ($viewData["products"] as $product)
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset($product->getImagePath()) }}"
          alt="{{ $product->getName() }}">
        <div class="card-body">
          <h5 class="card-title">{{ $product->getName() }}</h5>
          <p class="card-text">{{ __('cart.price') }} ${{ $product->getPrice() }}</p>
          <a href="{{ route('cart.remove', ['id' => $product->getId()])}}"
            class="btn btn-danger">{{ __('cart.remove') }}</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif
@endsection