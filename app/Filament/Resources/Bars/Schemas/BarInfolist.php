<?php

namespace App\Filament\Resources\Bars\Schemas;

use App\Models\Bar;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos sincronizados desde Prometeo')
                    ->schema([
                        TextEntry::make('name')->label('Nombre'),
                        TextEntry::make('holder')->label('Titular'),
                        TextEntry::make('dni_cif')->label('DNI/CIF'),
                        TextEntry::make('town')->label('Población'),
                        TextEntry::make('address')->label('Dirección')->columnSpanFull(),
                        TextEntry::make('machines_count')
                            ->label('Máquinas')
                            ->state(fn (Bar $record): int => $record->machines()->count()),
                        IconEntry::make('is_active')->label('Activo')->boolean(),
                        TextEntry::make('synced_at')
                            ->label('Última sincronización')
                            ->dateTime('d/m/Y H:i:s')
                            ->placeholder('Nunca'),
                    ])
                    ->columns(2),
            ]);
    }
}
