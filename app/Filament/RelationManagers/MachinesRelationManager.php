<?php

namespace App\Filament\RelationManagers;

use App\Filament\Resources\Machines\MachineResource;
use App\Models\Machine;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MachinesRelationManager extends RelationManager
{
    protected static string $relationship = 'machines';

    protected static ?string $title = 'Máquinas';

    protected static ?string $modelLabel = 'máquina';

    protected static ?string $pluralModelLabel = 'máquinas';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('alias')
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with('parent:id,alias'))
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
                TextColumn::make('parent.alias')
                    ->label('Máquina padre')
                    ->placeholder('—')
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('Activa')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('synced_at')
                    ->label('Sincronizada')
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
                TernaryFilter::make('is_active')
                    ->label('Actividad')
                    ->placeholder('Todas')
                    ->trueLabel('Activas')
                    ->falseLabel('Inactivas')
                    ->default(true),
            ])
            ->defaultSort('alias')
            ->recordUrl(fn (Machine $record): string => MachineResource::getUrl('view', ['record' => $record]));
    }
}
