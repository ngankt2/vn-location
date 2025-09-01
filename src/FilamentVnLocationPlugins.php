<?php

namespace Ngankt2\VNLocation;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Ngankt2\VNLocation\Filament\Resources\VNLocations\VNLocationResource;

class FilamentVnLocationPlugins implements Plugin
{

    private bool $showNavigationIcon = true;
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

    public function showNavigationIcon($bool=true): static
    {
        $this->showNavigationIcon = $bool;
        return $this;
    }
    public function getShowNavigationIcon(): bool
    {
        return $this->showNavigationIcon;
    }
}
