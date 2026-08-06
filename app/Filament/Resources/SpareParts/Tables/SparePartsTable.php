<?php

namespace App\Filament\Resources\SpareParts\Tables;

use App\Filament\Resources\DeliveryNotes\DeliveryNoteResource;
use App\Models\SparePart;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SparePartsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with([
                'factory:id,name',
                'state:id,name',
                'latestDeliveryNote',
            ]))
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('factory.name')
                    ->label('Fabricante')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('state.name')
                    ->label('Estado')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('latestDeliveryNote.id')
                    ->label('Último albarán')
                    ->formatStateUsing(fn (int|string $state): string => "Albarán #{$state}")
                    ->description(fn (SparePart $record): ?string => $record->latestDeliveryNote?->created_at?->format('d/m/Y H:i'))
                    ->placeholder('Sin albarán')
                    ->url(fn (SparePart $record): ?string => $record->latestDeliveryNote
                        ? DeliveryNoteResource::getUrl('edit', ['record' => $record->latestDeliveryNote])
                        : null),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('factory_id')
                    ->label('Fabricante')
                    ->relationship('factory', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('state_id')
                    ->label('Estado')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ]);
    }
}
