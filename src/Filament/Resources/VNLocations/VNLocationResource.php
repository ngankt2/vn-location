<?php
namespace Ngankt2\VNLocation\Filament\Resources\VNLocations;

use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Ngankt2\VNLocation\Enums\VNLocationType;
use Ngankt2\VNLocation\Filament\Resources\VNLocations\Pages\ManageVNLocations;
use Ngankt2\VNLocation\Models\VNLocation;

class VNLocationResource extends Resource
{
    protected static ?string $model = VNLocation::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return filament('filament-vn-location-plugins')->getShowNavigationIcon() ? Heroicon::OutlinedMapPin : null;
    }
    protected static bool $hasTitleCaseModelLabel = false;

    public static function getNavigationGroup(): ?string
    {
        return __('nav.system');
    }

    // 2. Thêm label để hiển thị tên thân thiện
    public static function getModelLabel(): string
    {
        return __('Tỉnh thành/Xã phường');
    }

    public static function getPluralLabel(): string
    {
        return __('Tỉnh thành/Xã phường');
    }

    // 3. Thêm navigation label để hiển thị bên sidebar
    public static function getNavigationLabel(): string
    {
        return __('Tỉnh thành/Xã phường');
    }


    /**
     * @throws \Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label(__('Tên'))
                    ->required()->inlineLabel()
                    ->maxLength(255),

                // Mã địa điểm
                Forms\Components\TextInput::make('code')
                    ->label(__('Mã'))
                    ->required()->inlineLabel()
                    ->unique(\Ngankt2\VNLocation\Models\VNLocation::class, 'code')
                    ->maxLength(20),

                // Loại địa điểm (tỉnh, huyện, xã,...)
                Forms\Components\TextInput::make('type')
                    ->label(__('Loại'))
                    ->formatStateUsing(fn($state)=>  VNLocationType::tryFrom($state)?->getLabel() ?? __('Không xác định'))
                    ->prefixIcon(fn($state)=>  VNLocationType::tryFrom($state)?->getIcon() ?? VNLocationType::XA->getIcon())
                    ->nullable()->inlineLabel()
                    ->maxLength(50),

                // Tên đầy đủ (bao gồm loại địa điểm)
                Forms\Components\TextInput::make('full_name')
                    ->label(__('Tên đầy đủ'))
                    ->nullable()->inlineLabel()
                    ->maxLength(255),

                // Đường dẫn đầy đủ (địa chỉ phân cấp)
                Forms\Components\TextInput::make('full_path')
                    ->label(__('Đường dẫn'))
                    ->inlineLabel()
                    ->nullable()
                    ->maxLength(512),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('type')
            ->paginationPageOptions([10, 25, 50, 100])
            ->columns([
                // Mã địa điểm
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->label(__('Mã')) // Label: "Mã"
                    ->searchable(), // Cho phép tìm kiếm theo mã

                // Đường dẫn đầy đủ (địa chỉ phân cấp)
                Tables\Columns\TextColumn::make('full_path')
                    ->label(__('Tên bao gồm tỉnh')) // Label: "Đường dẫn"
                    ->searchable(), // Cho phép tìm kiếm theo đường dẫn


                // Tên đầy đủ
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('Tên gọi')) // Label: "Tên đầy đủ"
                    ->searchable(), // Cho phép tìm kiếm theo tên đầy đủ


                // Loại (tỉnh, huyện, xã,...)
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Loại')) // Label: "Loại"
                    ->badge()
                    ->formatStateUsing(fn($state) => VNLocationType::tryFrom($state)?->getLabel() ?? __('Không xác định'))
                    ->color(fn($state) => VNLocationType::tryFrom($state)?->getColor() ?? VNLocationType::XA->getColor())
                    ->icon(fn($state) => VNLocationType::tryFrom($state)?->getIcon() ?? VNLocationType::XA->getIcon())
                    ->searchable(), // Cho phép tìm kiếm theo loại


                // Hiển thị tên địa phương cha nếu tồn tại
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('Tỉnh/Thành')) // Label: "Thuộc địa phương"
                    ->searchable(), // Cho phép tìm kiếm theo tên địa phương cha
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_code')
                    ->label(__('Thuộc địa phương'))
                    ->searchable()
                    ->options(VNLocation::query()->whereNull('parent_code')->pluck('full_name', 'code')),

                Tables\Filters\SelectFilter::make('type')
                    ->label(__('Loại'))
                    ->options(VNLocationType::class)

            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageVNLocations::route('/'),
        ];
    }
}
