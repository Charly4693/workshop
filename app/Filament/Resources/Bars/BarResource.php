<?php

namespace App\Filament\Resources\Bars;

use App\Filament\RelationManagers\MachinesRelationManager;
use App\Filament\Resources\Bars\Pages\ListBars;
use App\Filament\Resources\Bars\Pages\ViewBar;
use App\Filament\Resources\Bars\Schemas\BarInfolist;
use App\Filament\Resources\Bars\Tables\BarsTable;
use App\Models\Bar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BarResource extends Resource
{
    protected static ?string $model = Bar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static string|UnitEnum|null $navigationGroup = 'Prometeo';

    protected static ?string $navigationLabel = 'Bares';

    protected static ?string $modelLabel = 'bar';

    protected static ?string $pluralModelLabel = 'bares';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 30;

    public static function infolist(Schema $schema): Schema
    {
        return BarInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MachinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBars::route('/'),
            'view' => ViewBar::route('/{record}'),
        ];
    }
}
