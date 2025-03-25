<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageStorageProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function () {
            return new ImageLocalStorage;
        });
    }
}
