<?php

namespace Ngankt2\VNLocation;

use Illuminate\Support\ServiceProvider;

class VnLocationProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
