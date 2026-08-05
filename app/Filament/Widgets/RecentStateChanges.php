<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SpareParts\SparePartResource;
use App\Models\SparePartStateHistory;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentStateChanges extends TableWidget
{
    protected static ?int $sort = 40;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Actividad reciente')
            ->description('Últimos cambios registrados en el estado de los repuestos.')
            ->query(
                SparePartStateHistory::query()
                    ->with([
                        'sparePart:id,name',
                        'previousState:id,name',
                        'newState:id,name',
                        'changedBy:id,name',
                    ])
                    ->limit(10),
            )
            ->columns([
                TextColumn::make('sparePart.name')
                    ->label('Repuesto'),
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
                    ->dateTime('d/m/Y H:i:s'),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
            ->recordUrl(fn (SparePartStateHistory $record): string => SparePartResource::getUrl('edit', [
                'record' => $record->spare_part_id,
            ]))
            ->emptyStateHeading('Todavía no hay actividad registrada');
    }
}
