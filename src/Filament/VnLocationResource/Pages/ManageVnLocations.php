<?php

namespace Ngankt2\VNLocation\Filament\VnLocationResource\Pages;

use Ngankt2\VNLocation\Exports\VnLocationExporter;
use Ngankt2\VNLocation\Filament\VnLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVnLocations extends ManageRecords
{
    protected static string $resource = VnLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()->exporter(VnLocationExporter::class)->label(__("Xuất Excel, CSV"))
        ];
    }
}
