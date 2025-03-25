@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('wish_items.title') }}</h1>

    {{-- Display messages --}}
    @if (session('msg'))
        <div class="alert alert-info">
            {{ session('msg') }}
        </div>
    @endif

    <div class="row">
        @if ($viewData['wishItems']->isEmpty())
            <p>{{ __('wish_items.empty') }}</p>
        @else
            <ul class="list-group">
                @foreach ($viewData['wishItems'] as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->getProduct()->getName() }}

                        <div>
                            {{-- Add to Cart Button --}}
                            <a href="{{ route('cart.add', ['id' => $item->getProduct()->getId()]) }}" 
                               class="btn bg-primary text-white">
                                {{ __('product.add_cart') }}
                            </a>

                            {{-- Remove from Wishlist Form --}}
                            <form action="{{ route('wish_items.remove', ['id' => $item->getProduct()->getId()]) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('wish_items.remove') }}</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
