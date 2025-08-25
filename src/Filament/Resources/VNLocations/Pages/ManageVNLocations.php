<?php

namespace Ngankt2\VNLocation\Filament\Resources\VNLocations\Pages;

use Filament\Resources\Pages\ManageRecords;
use Ngankt2\VNLocation\Filament\Resources\VNLocations\VNLocationResource;

class ManageVNLocations extends ManageRecords
{
    protected static string $resource = VNLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
