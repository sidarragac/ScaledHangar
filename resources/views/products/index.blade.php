@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')

<center>
  <h1>{{ __('product.title_site') }}</h1>
</center>
@if($viewData["msg"])
<div class="alert alert-primary" role="alert">
  {{ $viewData["msg"] }}
</div>
@endif
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
                onchange="this.form.submit()">
              <label class="form-check-label">{{ $brand }}</label>
            </div>
            @endforeach
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-9">
    @if(count($viewData["products"]) === 0)
    <div class="alert alert-warning" role="alert">
      {{ __('product.no_products') }}
    </div>
    @endif
    <div class="d-flex flex-row flex-wrap justify-content-center justify-content-md-start gap-3">
      @foreach ($viewData["products"] as $product)
      <div class="card" style="width: 18rem;">
        <img src="{{ asset($product->getImagePath()) }}" class="card-img-top" alt="{{ $product->getName() }}">
        <div class="card-body">
          <h5 class="card-title">{{ $product->getName() }}</h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">{{ __('product.price') }} ${{ $product->getPrice() }}</li>
          <li class="list-group-item">{{ __('product.brand') }} {{ $product->getBrand() }}</li>
        </ul>
        <div class="card-body text-center">
          <a href="{{ route('product.show', ['id' => $product->getId()])}}">
            <button class="btn btn-primary" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi    bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
              </svg>
              More information
            </button>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<link rel="stylesheet" href="{{ asset('css/product/index.css') }}">
@endsection