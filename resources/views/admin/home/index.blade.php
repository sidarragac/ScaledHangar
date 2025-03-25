@extends('layouts.admin')

@section('content')
<div class="container mt-4 text-center">
  <h1 class="mb-4">{{ __('adminMessages.welcome') }}</h1>

  <div class="d-flex justify-content-center">
    <img src="{{ asset('img/logoText.png') }}" alt="Admin Dashboard" class="img-fluid rounded shadow-lg"
      style="max-width: 400px;">
  </div>
</div>
@endsection