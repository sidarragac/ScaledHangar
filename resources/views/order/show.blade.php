@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')
<center>
  <h1>{{ __('order.title_show_site', ['id' => $viewData['order']->getId()]) }}</h1>
</center>
<div class="row d-flex justify-content-center align-items-md-start align-items-center flex-md-row flex-column">
  <div class="card px-0" style="width: 18rem;">
    <div class="card-header">
      {{ __('cart.cart_info') }}
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">{{ __('order.product') }} {{ $viewData['totalProducts'] }}</li>
      <li class="list-group-item">{{ __('order.price') }} ${{ $viewData['totalPrice'] }}</li>
    </ul>
    <div class="card-body text-center">
      <a href="{{ route('order.index') }}" class="btn bg-primary text-white card-link">
        {{ __('order.back') }}
      </a>
    </div>
  </div>
  <div class="col-9">
    <table class="table">
      <thead>
        <tr>
          <th scope="col"># Id</th>
          <th scope="col">{{ __('order.name') }}</th>
          <th scope="col">{{ __('order.brand') }}</th>
          <th scope="col">{{ __('order.price') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData["products"] as $product)
        <tr>
          <th scope="row">{{ $product->getId() }}</th>
          <td>{{ $product->getName() }}</td>
          <td>{{ $product->getBrand() }}</td>
          <td>${{ $product->getPrice() }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection