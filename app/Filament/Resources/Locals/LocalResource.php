<?php

namespace App\Filament\Resources\Locals;

use App\Filament\RelationManagers\MachinesRelationManager;
use App\Filament\Resources\Locals\Pages\ListLocals;
use App\Filament\Resources\Locals\Pages\ViewLocal;
use App\Filament\Resources\Locals\Schemas\LocalInfolist;
use App\Filament\Resources\Locals\Tables\LocalsTable;
use App\Models\Local;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LocalResource extends Resource
{
    protected static ?string $model = Local::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static string|UnitEnum|null $navigationGroup = 'Prometeo';

    protected static ?string $navigationLabel = 'Locales';

    protected static ?string $modelLabel = 'local';

    protected static ?string $pluralModelLabel = 'locales';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 20;

    public static function infolist(Schema $schema): Schema
    {
        return LocalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalsTable::configure($table);
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
            'index' => ListLocals::route('/'),
            'view' => ViewLocal::route('/{record}'),
        ];
    }
}
