@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ __('order.order_details') }} #{{ $viewData['order']->getId() }}</h2>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{ __('order.user_info') }}</h4>
                    <p>{{ $viewData['order']->getUser()->getName() }}</p>
                    <p>{{ $viewData['order']->getUser()->getEmail() }}</p>
                </div>
                
                <div class="col-md-6">
                    <h4>{{ __('order.order_info') }}</h4>
                    <p><strong>{{ __('order.total') }}:</strong> ${{ number_format($viewData['order']->getTotal(), 2) }}</p>
                    <p><strong>{{ __('order.status') }}:</strong> {{ __("order.status_{$viewData['order']->getStatus()}") }}</p>
                </div>
            </div>
            
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                {{ __('order.back') }}
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/admin/orders/show.css') }}" rel="stylesheet">
@endsection