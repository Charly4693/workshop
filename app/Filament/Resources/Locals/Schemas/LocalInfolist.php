<?php

namespace App\Filament\Resources\Locals\Schemas;

use App\Models\Local;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocalInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos sincronizados desde Prometeo')
                    ->schema([
                        TextEntry::make('name')->label('Nombre'),
                        TextEntry::make('idMachines')->label('Identificador operativo'),
                        TextEntry::make('machines_count')
                            ->label('Máquinas')
                            ->state(fn (Local $record): int => $record->machines()->count()),
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
