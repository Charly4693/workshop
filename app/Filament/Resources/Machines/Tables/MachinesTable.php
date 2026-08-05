<?php

namespace App\Filament\Resources\Machines\Tables;

use App\Models\Machine;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MachinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with([
                'local:id,name',
                'bar:id,name',
                'parent:id,alias',
            ]))
            ->columns([
                TextColumn::make('alias')
                    ->label('Alias')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('identificador')
                    ->label('Identificador')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->placeholder('Sin tipo')
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Ubicación')
                    ->state(fn (Machine $record): string => $record->local?->name
                        ?? $record->bar?->name
                        ?? '—')
                    ->searchable(
                        query: fn (Builder $query, string $search): Builder => $query
                            ->whereHas('local', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%"))
                            ->orWhereHas('bar', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%")),
                    ),
                TextColumn::make('parent.alias')
                    ->label('Padre')
                    ->placeholder('—')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'parent' => 'Parent',
                        'roulette' => 'Roulette',
                        'single' => 'Single',
                        'AADD' => 'AADD',
                    ]),
                SelectFilter::make('local_id')
                    ->label('Local')
                    ->relationship('local', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('bar_id')
                    ->label('Bar')
                    ->relationship('bar', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('parent_id')
                    ->label('Máquina padre')
                    ->relationship('parent', 'alias')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('is_active')
                    ->label('Actividad')
                    ->placeholder('Todos')
                    ->trueLabel('Activas')
                    ->falseLabel('Inactivas')
                    ->default(true),
            ])
            ->defaultSort('alias')
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
