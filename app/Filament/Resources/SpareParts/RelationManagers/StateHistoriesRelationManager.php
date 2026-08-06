<?php

namespace App\Filament\Resources\SpareParts\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StateHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'stateHistories';

    protected static ?string $title = 'Historial de estados';

    protected static ?string $modelLabel = 'cambio de estado';

    protected static ?string $pluralModelLabel = 'cambios de estado';

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with([
                'previousState:id,name',
                'newState:id,name',
                'changedBy:id,name',
            ]))
            ->columns([
                TextColumn::make('previousState.name')
                    ->label('Estado anterior')
                    ->placeholder('Estado inicial')
                    ->badge(),
                TextColumn::make('newState.name')
                    ->label('Estado nuevo')
                    ->badge(),
                TextColumn::make('changedBy.name')
                    ->label('Modificado por')
                    ->placeholder('Sistema'),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
