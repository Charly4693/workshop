<?php

namespace App\Filament\Resources\States\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('spare_parts_count')
                    ->label('Repuestos')
                    ->counts('spareParts')
                    ->badge()
                    ->sortable(),
                TextColumn::make('delivery_notes_count')
                    ->label('Albaranes')
                    ->counts('deliveryNotes')
                    ->badge()
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
