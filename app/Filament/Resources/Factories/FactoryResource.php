<?php

namespace App\Filament\Resources\Factories;

use App\Filament\Resources\Factories\Pages\CreateFactory;
use App\Filament\Resources\Factories\Pages\EditFactory;
use App\Filament\Resources\Factories\Pages\ListFactories;
use App\Filament\Resources\Factories\RelationManagers\SparePartsRelationManager;
use App\Filament\Resources\Factories\Schemas\FactoryForm;
use App\Filament\Resources\Factories\Tables\FactoriesTable;
use App\Models\Factory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FactoryResource extends Resource
{
    protected static ?string $model = Factory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogo';

    protected static ?string $navigationLabel = 'Fabricantes';

    protected static ?string $modelLabel = 'fabricante';

    protected static ?string $pluralModelLabel = 'fabricantes';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return FactoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FactoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SparePartsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFactories::route('/'),
            'create' => CreateFactory::route('/create'),
            'edit' => EditFactory::route('/{record}/edit'),
        ];
    }
}
