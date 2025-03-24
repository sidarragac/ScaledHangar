@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>{{ $viewData['title'] }}</h1>
    <p><strong>{{ __('admin/product.name') }}:</strong> {{ $viewData['product']->getName() }}</p>
    <p><strong>{{ __('admin/product.description') }}:</strong> {{ $viewData['product']->getDescription() }}</p>
    <p><strong>{{ __('admin/product.price') }}:</strong> ${{ $viewData['product']->getPrice() }}</p>
    <p><strong>{{ __('admin/product.stock') }}:</strong> {{ $viewData['product']->getStock() }}</p>
    <p><strong>{{ __('admin/product.brand') }}:</strong> {{ $viewData['product']->getBrand() }}</p>
    <p><strong>{{ __('admin/product.category') }}:</strong> {{ $viewData['product']->getCategory()->getName() }}</p>
    <img src="{{URL::asset($viewData['product']->getImagePath()) }}" class="img-fluid" style="max-width: 200px;">
    <a href="{{ route('admin.product.index') }}" class="btn btn-primary mt-3">{{__('admin/product.btn_back')}}</a>
</div>
@endsection
