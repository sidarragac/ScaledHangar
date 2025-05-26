@extends('layouts.admin')
@section('content')
<div class="container">
  <h1>{{ $viewData['title'] }}</h1>
  <form action="{{ route('admin.product.update', $viewData['product']->getId()) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.name') }}</label>
      <input type="text" name="name" class="form-control" value="{{ $viewData['product']->getName() }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.description') }}</label>
      <textarea name="description" class="form-control" required>{{ $viewData['product']->getDescription() }}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.price') }}</label>
      <input type="number" name="price" class="form-control" value="{{ $viewData['product']->getPrice() }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.stock') }}</label>
      <input type="number" name="stock" class="form-control" value="{{ $viewData['product']->getStock() }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.brand') }}</label>
      <input type="text" name="brand" class="form-control" value="{{ $viewData['product']->getBrand() }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">{{ __('admin/product.category') }}</label>
      <select name="category_id" class="form-control" required>
        @foreach ($viewData['categories'] as $category)
        <option value="{{ $category->getId() }}" @if($category->getId() == $viewData['product']->getCategory()->getId())
          selected @endif>
          {{ $category->getName() }}
        </option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">{{__('admin/product.edit_form_label_image')}}</label>
      <input type="file" name="image" class="form-control">
      <img src="{{asset(' $viewData['product']->getImagePath()) }}" class="img-fluid mt-2"
        style="max-width: 200px;">
    </div>
    <button type="submit" class="btn btn-success">{{__('admin/product.btn_submit_edit')}}</button>
  </form>
</div>
@endsection