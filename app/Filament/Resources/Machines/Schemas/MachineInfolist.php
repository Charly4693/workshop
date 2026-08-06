<?php

namespace App\Filament\Resources\Machines\Schemas;

use App\Models\Machine;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos sincronizados desde Prometeo')
                    ->schema([
                        TextEntry::make('name')->label('Nombre'),
                        TextEntry::make('alias')->label('Alias'),
                        TextEntry::make('identificador')->label('Identificador'),
                        TextEntry::make('type')->label('Tipo')->badge()->placeholder('Sin tipo'),
                        TextEntry::make('location')
                            ->label('Ubicación')
                            ->state(fn (Machine $record): string => $record->local?->name
                                ?? $record->bar?->name
                                ?? '—'),
                        TextEntry::make('parent.alias')
                            ->label('Máquina padre')
                            ->placeholder('Ninguna'),
                        TextEntry::make('children_count')
                            ->label('Máquinas hijas')
                            ->state(fn (Machine $record): int => $record->children()->count()),
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
