<?php

namespace App\Filament\Resources\Machines;

use App\Filament\Resources\Machines\Pages\ListMachines;
use App\Filament\Resources\Machines\Pages\ViewMachine;
use App\Filament\Resources\Machines\Schemas\MachineInfolist;
use App\Filament\Resources\Machines\Tables\MachinesTable;
use App\Models\Machine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MachineResource extends Resource
{
    protected static ?string $model = Machine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedServerStack;

    protected static string|UnitEnum|null $navigationGroup = 'Prometeo';

    protected static ?string $navigationLabel = 'Máquinas';

    protected static ?string $modelLabel = 'máquina';

    protected static ?string $pluralModelLabel = 'máquinas';

    protected static ?string $recordTitleAttribute = 'alias';

    protected static ?int $navigationSort = 40;

    public static function infolist(Schema $schema): Schema
    {
        return MachineInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MachinesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMachines::route('/'),
            'view' => ViewMachine::route('/{record}'),
        ];
    }
}
