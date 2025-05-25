<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name'=> $this->getName(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
            'brand' => $this->getBrand(),
            'stock' => $this->getStock(),
            'sold' => $this->getSold(),
            'category' => $this->getCategory(),
            'imagePath' => $this->getImagePath(),
            'url' => url(route('product.show', ['id' => $this->getId()], false)),
        ];
    }
}
