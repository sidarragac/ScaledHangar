@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ __('order.edit_order') }} #{{ $viewData['order']->getId() }}</h2>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.update', $viewData['order']->getId()) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">{{ __('order.status') }}</label>
                    <select name="status" class="form-select">
                        @foreach(['pending', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $viewData['order']->getStatus() === $status ? 'selected' : '' }}>
                            {{ __("order.status_{$status}") }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">{{ __('order.total') }}</label>
                    <input type="number" step="0.01" name="total" 
                           value="{{ old('total', $viewData['order']->getTotal()) }}" 
                           class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">{{ __('order.update') }}</button>
            </form>
            
            <form method="POST" action="{{ route('admin.orders.destroy', $viewData['order']->getId()) }}" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('order.delete') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/admin/orders/edit.css') }}" rel="stylesheet">
@endsection