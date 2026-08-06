<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DeliveryNotes\DeliveryNoteResource;
use App\Models\DeliveryNote;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestDeliveryNotes extends TableWidget
{
    protected static ?int $sort = 10;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Últimos 10 albaranes')
            ->description('Albaranes creados más recientemente.')
            ->query(
                DeliveryNote::query()
                    ->with([
                        'sparepart:id,name',
                        'state:id,name',
                        'user:id,name',
                        'local:id,name',
                        'bar:id,name',
                        'machine:id,alias',
                    ])
                    ->limit(10),
            )
            ->columns([
                TextColumn::make('sparepart.name')
                    ->label('Repuesto')
                    ->placeholder('Repuesto eliminado'),
                TextColumn::make('state.name')
                    ->label('Estado')
                    ->badge(),
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
                    ->placeholder('Máquina eliminada'),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
            ->recordUrl(fn (DeliveryNote $record): string => DeliveryNoteResource::getUrl('edit', ['record' => $record]))
            ->emptyStateHeading('Todavía no hay albaranes');
    }
}
