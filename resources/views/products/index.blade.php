@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')

<center>
  <h1>{{ __('product.title_site') }}</h1>
</center>
<div class="row d-flex justify-content-center align-items-md-start align-items-center flex-md-row flex-column">
  <div class="accordion col-md-3 col-9 mb-2" id="filterAccordion">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
          {{ __('product.filter') }}
        </button>
      </h2>
      <div id="filterCollapse" class="accordion-collapse collapse">
        <div class="accordion-body">
          <form method="GET" action="{{ route('product.index') }}">
            <label>{{ __('product.sales') }}</label>
            <select name="sort_sold" class="form-select" onchange="this.form.submit()">
              <option value="">{{ __('product.select') }}</option>
              <option value="desc" {{ request('sort_sold') === 'desc' ? 'selected' : '' }}>{{ __('product.desc') }}</option>
              <option value="asc" {{ request('sort_sold') === 'asc' ? 'selected' : '' }}>{{ __('product.asc') }}</option>
            </select>

            <label class="mt-2">{{ __('product.price') }}</label>
            <select name="sort_price" class="form-select" onchange="this.form.submit()">
              <option value="">{{ __('product.select') }}</option>
              <option value="asc" {{ request('sort_price') === 'asc' ? 'selected' : '' }}>{{ __('product.asc') }}</option>
              <option value="desc" {{ request('sort_price') === 'desc' ? 'selected' : '' }}>{{ __('product.desc') }}</option>
            </select>

            <label class="mt-2">{{ __('product.category') }}</label>
            <select name="category_id" class="form-select" onchange="this.form.submit()">
              <option value="">{{ __('product.all_categories') }}</option>
              @foreach($viewData["categories"] as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>

            <label class="mt-2">{{ __('product.brand') }}</label>
            @foreach($viewData['brands'] as $brand)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand }}"
                  {{ in_array($brand, request()->input('brands', [])) ? 'checked' : '' }}
                  onchange="this.form.submit()"
                >
                <label class="form-check-label">{{ $brand }}</label>
              </div>
            @endforeach
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-9">
    @if($viewData["products"]->isEmpty())
      <div class="alert alert-warning" role="alert">
        {{ __('product.no_products') }}
      </div>
    @endif
    <div class="d-flex flex-row flex-wrap justify-content-center justify-content-md-start gap-3">
      @foreach ($viewData["products"] as $product)
      <div class="card" style="width: 18rem;">
        <img src="{{ asset('storage/' . $product->getImagePath()) }}" class="card-img-top" alt="{{ $product->getName() }}">
        <div class="card-body">
          <h5 class="card-title">{{ $product->getName() }}</h5>
          <p class="card-text">{{ $product->getDescription() }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">{{ __('product.price') }} ${{ $product->getPrice() }}</li>
          <li class="list-group-item">{{ __('product.brand') }} {{ $product->getBrand() }}</li>
        </ul>
        <div class="card-body text-center">
          @if($product->getStock() > 0)
            <a href="#" class="btn bg-primary text-white card-link">{{ __('product.add_cart') }}</a>
          @else
            <p class="alert alert-danger mb-0 py-2" role="alert">
              {{ __('product.sold_out') }}
            </p>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<link rel="stylesheet" href="{{ asset('css/product/index.css') }}">
@endsection
