<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\PostFactory;
use App\Factories\PostFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostFactoryInterface::class, PostFactory::class);
    }
}