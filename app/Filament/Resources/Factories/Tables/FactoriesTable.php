<?php

namespace App\Filament\Resources\Factories\Tables;

use App\Models\Factory;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FactoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('cif')
                    ->label('CIF')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('spare_parts_count')
                    ->label('Repuestos')
                    ->counts('spareParts')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('city')
                    ->label('Ciudad')
                    ->options(fn (): array => Factory::query()
                        ->whereNotNull('city')
                        ->where('city', '!=', '')
                        ->distinct()
                        ->orderBy('city')
                        ->pluck('city', 'city')
                        ->all())
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
