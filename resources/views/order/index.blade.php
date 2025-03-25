@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')
<center>
  <h1>{{ __('order.title_index_site') }}</h1>
</center>
@if(count($viewData["orders"]) === 0)
<div class="alert alert-primary" role="alert">
  {{ __('order.no_orders') }}
</div>
@else
<table class="table">
  <thead>
    <tr>
      <th scope="col"># Id</th>
      <th scope="col">{{ __('order.total_price') }}</th>
      <th scope="col">{{ __('order.created_date') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($viewData["orders"] as $order)
    <tr>
      <th scope="row">
        <a href="{{ route('order.show', ['id' => $order->getId()]) }}">
          {{ $order->getId() }}
        </a>
      </th>
      <td>{{ $order->getTotal() }}</td>
      <td>{{ $order->getCreatedAt() }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection
