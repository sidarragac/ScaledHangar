<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageStorage
{
    public function store(Request $request, string $productName): string;

    public function delete(string $path): void;
}
