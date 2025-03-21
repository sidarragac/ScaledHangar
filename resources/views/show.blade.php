@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('order.order_details') }} #{{ $viewData['order']->getId() }}</h1>
    
    <div class="card">
        <div class="card-body">
            <h5>{{ __('order.total') }}: ${{ number_format($viewData['order']->getTotal(), 2) }}</h5>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('order.product') }}</th>
                        <th>{{ __('order.quantity') }}</th>
                        <th>{{ __('order.price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['order']->items as $item)
                    <tr>
                        <td>{{ $item->product->getName() }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <a href="{{ route('orders.invoice', $viewData['order']->getId()) }}" class="btn btn-primary">
                {{ __('order.generate_invoice') }}
            </a>
        </div>
    </div>
</div>
@endsection