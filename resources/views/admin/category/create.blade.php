@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<h1>{{ $viewData['title'] }}</h1>
<form action="{{ route('admin.category.save') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">{{__('admin/category.create_form_label')}}</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">{{__('admin/category.btn_submit_create')}}</button>
</form>
@endsection