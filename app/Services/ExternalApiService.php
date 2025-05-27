<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalApiService
{
    public function getProducts(): array
    {
        $response = Http::get('http://medallobike.shop/api/products');

        if ($response->successful()) {
            return $response->json()['data'] ?? [];
        }

        return [];
    }
}
