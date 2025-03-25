@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<h1>{{ $viewData['title'] }}</h1>
<form action="{{ route('admin.category.update', $viewData['category']->getId()) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">{{__('admin/category.edit_form_label_name')}}</label>
        <input type="text" name="name" class="form-control" value="{{ $viewData['category']->getName() }}" required>
    </div>
    <button type="submit" class="btn btn-primary">{{__('admin/category.btn_submit_edit')}}</button>
</form>
@endsection