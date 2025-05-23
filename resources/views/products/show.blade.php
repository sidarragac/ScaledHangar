@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')

<div class="row">
  <div class="col-md-6 d-flex align-items-center justify-content-center">
    <img src="{{ asset($viewData['product']->getImagePath()) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $viewData['product']->getName() }}">
  </div>

  <div class="col-md-6 d-flex flex-column align-items-center justify-content-center text-center">
    <h2>{{ $viewData['product']->getName() }}</h2>
    <p>{{ $viewData['product']->getDescription() }}</p>
    <div class="text-center mb-3">
      <h4 class="text-success">${{ number_format($viewData['product']->getPrice(), 2) }}</h4>
      <p class="text-muted">Fabricado por: <strong>{{ $viewData['product']->getBrand() }}</strong></p>
    </div>
    @if ($viewData['product']->getStock() > 0)
      <form action="{{ route('cart.add', $viewData['product']->getId()) }}" method="POST" class="w-100 d-flex flex-column align-items-center">
        @csrf
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control mb-3 text-center" style="width: 100px;" value="1" min="1" max="{{ $viewData['product']->getStock() }}" required>
        
        <div class="d-flex justify-content-center gap-3">
          <button type="submit" class="btn btn-primary">Agregar al carrito</button>
          <a href="{{ route('wish_items.add', $viewData['product']->getId()) }}" class="btn btn-outline-secondary">Agregar a Wishlist</a>
        </div>
      </form>
    @else
      <div class="text-center mb-3">
        <button class="btn btn-danger" disabled>No hay unidades disponibles</button>
      </div>

      <div class="text-center">
        <a href="{{ route('wish_items.add', $viewData['product']->getId()) }}" class="btn btn-outline-secondary">Agregar a Wishlist</a>
      </div>
    @endif
  </div>
</div>
@if($viewData['relatedProducts']->isNotEmpty())
  <div class="row mt-5">
    <h3 class="text-center">Productos Relacionados</h3>
    @foreach ($viewData['relatedProducts'] as $relatedProduct)
      <div class="card" style="width: 18rem;">
        <img src="{{ asset($relatedProduct->getImagePath()) }}" class="card-img-top" alt="{{ $relatedProduct->getName() }}">
        <div class="card-body">
          <h5 class="card-title">{{ $relatedProduct->getName() }}</h5>
          <p class="card-text"><small class="text-body-secondary">Precio: ${{ $relatedProduct->getPrice() }}</small></p>
          <a href="{{ route('product.show', $relatedProduct->getId()) }}" class="btn btn-primary">Ver más</a>
        </div>
      </div>
    @endforeach
  </div>
@endif




<link rel="stylesheet" href="{{ asset('css/product/index.css') }}">
@endsection
