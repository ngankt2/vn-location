<?php

namespace Ngankt2\VNLocation\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum VNLocationType: string implements HasLabel, HasColor, HasIcon
{
    case TINH = 'tinh';
    case THANH_PHO = 'thanh-pho';
    case XA = 'xa';
    case PHUONG = 'phuong';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TINH => 'Tỉnh',
            self::THANH_PHO => 'Thành phố',
            self::XA => 'Xã',
            self::PHUONG => 'Phường',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::TINH => 'primary',
            self::THANH_PHO => 'success',
            self::XA => 'info',
            self::PHUONG => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TINH,self::THANH_PHO => 'heroicon-o-building-library',
            self::XA => 'heroicon-o-home-modern',
            self::PHUONG => 'heroicon-o-map-pin',
        };
    }
}
