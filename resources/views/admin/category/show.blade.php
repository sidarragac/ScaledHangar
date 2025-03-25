@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<h1>{{ $viewData['title'] }}</h1>
<p><strong>ID:</strong> {{ $viewData['category']->getId() }}</p>
<p><strong>Name:</strong> {{ $viewData['category']->getName() }}</p>
<a href="{{ route('admin.category.index') }}" class="btn btn-secondary">{{__('admin/category.btn_back')}}</a>
@endsection