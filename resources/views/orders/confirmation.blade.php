@extends('layouts.app')

@section('title', $viewData["title"])

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">{{ __('order.thank_you') }}</h3>
        </div>
        
        <div class="card-body">
            <div class="alert alert-success">
                {{ __('order.confirmation_message') }}
            </div>

            <h4>{{ __('order.details') }}</h4>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>{{ __('order.order_number') }}:</strong> {{ $order->order_number }}</p>
                    <p><strong>{{ __('order.date') }}:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>{{ __('order.total') }}:</strong> ${{ number_format($order->total, 2) }}</p>
                    <p><strong>{{ __('order.status') }}:</strong> {{ ucfirst($order->status) }}</p>
                </div>
            </div>

            <h5>{{ __('order.items') }}</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('order.product_name') }}</th>
                            <th>{{ __('order.price') }}</th>
                            <th>{{ __('order.quantity') }}</th>
                            <th>{{ __('order.subtotal') }}</th>
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
                {{ __('order.continue_shopping') }}
            </a>
        </div>
    </div>
</div>
@endsection