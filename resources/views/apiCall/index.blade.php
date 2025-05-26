@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($viewData['products'] as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product['title'] }}</h5>
                    <p class="card-text">{{ $product['description'] }}</p>
                    <strong>${{ number_format($product['price'], 0, ',', '.') }}</strong>
                    <br>
                    <a href="{{ $product['links']['view'] }}" class="btn btn-primary mt-2" target="_blank">Ver Producto</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection