@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ __('order.create_order') }}</h2>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">{{ __('order.user') }}</label>
                    <select name="user_id" class="form-select">
                        @foreach($viewData['users'] as $user)
                        <option value="{{ $user->getId() }}">{{ $user->getName() }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">{{ __('order.status') }}</label>
                    <select name="status" class="form-select">
                        <option value="pending">{{ __('order.status_pending') }}</option>
                        <option value="completed">{{ __('order.status_completed') }}</option>
                        <option value="cancelled">{{ __('order.status_cancelled') }}</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('order.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/admin/orders/create.css') }}" rel="stylesheet">
@endsection