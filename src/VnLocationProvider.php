<?php

namespace Ngankt2\VNLocation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VnLocationProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vn-location');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }
}
