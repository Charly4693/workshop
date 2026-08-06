<?php

namespace App\Filament\Resources\SpareParts\RelationManagers;

use App\Filament\Resources\DeliveryNotes\DeliveryNoteResource;
use App\Models\DeliveryNote;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DeliveryNotesRelationManager extends RelationManager
{
    protected static string $relationship = 'deliveryNotes';

    protected static ?string $title = 'Albaranes asociados';

    protected static ?string $modelLabel = 'albarán';

    protected static ?string $pluralModelLabel = 'albaranes';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with([
                'state:id,name',
                'user:id,name',
                'local:id,name',
                'bar:id,name',
                'machine:id,alias',
            ]))
            ->columns([
                TextColumn::make('id')
                    ->label('Albarán')
                    ->formatStateUsing(fn (int|string $state): string => "#{$state}")
                    ->sortable(),
                TextColumn::make('state.name')
                    ->label('Estado')
                    ->badge()
                    ->placeholder('Sin estado'),
                TextColumn::make('user.name')
                    ->label('Técnico')
                    ->placeholder('Sin responsable'),
                TextColumn::make('location')
                    ->label('Ubicación')
                    ->state(fn (DeliveryNote $record): string => $record->local?->name
                        ?? $record->bar?->name
                        ?? '—'),
                TextColumn::make('machine.alias')
                    ->label('Máquina')
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(fn (DeliveryNote $record): string => DeliveryNoteResource::getUrl('edit', ['record' => $record]));
    }
}
