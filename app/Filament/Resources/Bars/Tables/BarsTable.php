<?php

namespace App\Filament\Resources\Bars\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('holder')
                    ->label('Titular')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('dni_cif')
                    ->label('DNI/CIF')
                    ->searchable(),
                TextColumn::make('town')
                    ->label('Población')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('machines_count')
                    ->label('Máquinas')
                    ->counts('machines')
                    ->badge()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('synced_at')
                    ->label('Sincronizado')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Nunca')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Actividad')
                    ->placeholder('Todos')
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos')
                    ->default(true),
            ])
            ->defaultSort('name')
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
