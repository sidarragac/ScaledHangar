@extends('layouts.app')

@section('title', $viewData["title"])

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Thank You for Your Order!</h3>
        </div>
        
        <div class="card-body">
            <div class="alert alert-success">
                Your order has been placed successfully.
            </div>

            <h4>Order Details</h4>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                </div>
            </div>

            <h5>Order Items</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer text-center">
            <a href="{{ route('home.index') }}" class="btn btn-primary">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection