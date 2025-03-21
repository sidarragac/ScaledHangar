@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ __('order.orders') }}</h2>
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
                {{ __('order.create_new') }}
            </a>
        </div>
        
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('order.id') }}</th>
                        <th>{{ __('order.user') }}</th>
                        <th>{{ __('order.total') }}</th>
                        <th>{{ __('order.status') }}</th>
                        <th>{{ __('order.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['orders'] as $order)
                    <tr>
                        <td>{{ $order->getId() }}</td>
                        <td>{{ $order->getUser()->getName() }}</td>
                        <td>${{ number_format($order->getTotal(), 2) }}</td>
                        <td>{{ __("order.status_{$order->getStatus()}") }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->getId()) }}" class="btn btn-info">
                                {{ __('order.show') }}
                            </a>
                            <a href="{{ route('admin.orders.edit', $order->getId()) }}" class="btn btn-warning">
                                {{ __('order.edit') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/admin/orders/index.css') }}" rel="stylesheet">
@endsection