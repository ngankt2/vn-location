<?php

namespace Ngankt2\VNLocation;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Ngankt2\FilamentRecruitment\Filament\RecruitmentPositionResource;
use Ngankt2\VNLocation\Filament\VnLocationResource;

class FilamentVnLocationPlugins implements Plugin
{
    public function getId(): string
    {
        return 'filament-vn-location-plugins';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            VnLocationResource::class
        ]);

    }

    public function boot(Panel $panel): void
    {

    }

    public static function make(): static
    {
        return new static;
    }
}
