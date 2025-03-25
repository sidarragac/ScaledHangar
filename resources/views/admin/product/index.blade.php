<!-- resources/views/admin/product/index.blade.php -->
@extends('layouts.admin')
@section('content')
<div class="container">
  <h1>{{ $viewData['title'] }}</h1>
  @if($viewData['msg'])
  <div class="alert alert-success">{{ $viewData['msg'] }}</div>
  @endif
  <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3">{{ __('admin/product.btn_create') }}</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>{{ __('admin/product.name') }}</th>
        <th>{{ __('admin/product.price') }}</th>
        <th>{{ __('admin/product.stock') }}</th>
        <th>{{ __('admin/product.brand') }}</th>
        <th>{{__('admin/product.actions')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($viewData['products'] as $product)
      <tr>
        <td>{{ $product->getId() }}</td>
        <td>{{ $product->getName() }}</td>
        <td>{{ $product->getPrice() }}</td>
        <td>{{ $product->getStock() }}</td>
        <td>{{ $product->getBrand() }}</td>
        <td>
          <a href="{{ route('admin.product.show', $product->getId()) }}"
            class="btn btn-info">{{__('admin/product.action_btn_show')}}</a>
          <a href="{{ route('admin.product.edit', $product->getId()) }}"
            class="btn btn-warning">{{__('admin/product.action_btn_edit')}}</a>
          <form action="{{ route('admin.product.delete', $product->getId()) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
              onclick="return confirm('Are you sure?')">{{__('admin/product.action_btn_delete')}}</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection