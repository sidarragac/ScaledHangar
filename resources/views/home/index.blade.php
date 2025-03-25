@extends('layouts.app')


@section('content')
<div class="container mt-4 text-center">
  <h1 class="mb-4">{{ __('messages.welcome') }}</h1>

  <div class="d-flex justify-content-center">
    <img src="{{ asset('img/logoText.png') }}" alt="Company Logo" class="img-fluid rounded shadow-lg"
      style="max-width: 400px;">
  </div>
</div>
@endsection