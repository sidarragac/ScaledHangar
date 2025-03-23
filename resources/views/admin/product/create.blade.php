@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $viewData['title'] }}</h1>
    <form action="{{ route('admin.product.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('admin/product.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin/product.description') }}</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin/product.price') }}</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin/product.stock') }}</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin/product.category') }}</label>
            <select name="category_id" class="form-control" required>
                @foreach ($viewData['categories'] as $category)
                    <option value="{{ $category->id }}">{{ $category->getName() }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('admin/product.create_form_label_image')}}</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">{{__('admin/product.btn_submit_create')}}</button>
    </form>
</div>
@endsection
