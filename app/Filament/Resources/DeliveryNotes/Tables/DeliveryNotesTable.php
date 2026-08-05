<?php

namespace App\Filament\Resources\DeliveryNotes\Tables;

use App\Models\DeliveryNote;
use App\Models\State;
use App\Services\DeliveryNoteWorkflow;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DeliveryNotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with([
                'sparepart:id,name',
                'state:id,name',
                'user:id,name',
                'local:id,name',
                'bar:id,name',
                'machine:id,name,alias',
            ]))
            ->columns([
                TextColumn::make('sparepart.name')
                    ->label('Repuesto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('state.name')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (?string $state): string => self::stateColor($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Técnico')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Ubicación')
                    ->state(fn (DeliveryNote $record): string => $record->local?->name
                        ?? $record->bar?->name
                        ?? '—')
                    ->searchable(
                        query: fn (Builder $query, string $search): Builder => $query
                            ->whereHas('local', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%"))
                            ->orWhereHas('bar', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%")),
                    ),
                TextColumn::make('machine.alias')
                    ->label('Máquina')
                    ->description(fn (DeliveryNote $record): ?string => $record->machine?->name)
                    ->searchable(['alias', 'name'])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('state_id')
                    ->label('Estado')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('user_id')
                    ->label('Técnico')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
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
                SelectFilter::make('machine_id')
                    ->label('Máquina')
                    ->relationship('machine', 'alias')
                    ->searchable()
                    ->preload(),
                Filter::make('created_at')
                    ->label('Rango de fechas')
                    ->schema([
                        DatePicker::make('from')->label('Desde'),
                        DatePicker::make('until')->label('Hasta'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when($data['from'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '>=', $date))
                        ->when($data['until'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '<=', $date)))
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make("Desde: {$data['from']}")->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make("Hasta: {$data['until']}")->removeField('until');
                        }

                        return $indicators;
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('changeState')
                    ->label('Cambiar estado')
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->schema([
                        Select::make('state_id')
                            ->label('Nuevo estado')
                            ->options(fn (): array => State::query()->orderBy('name')->pluck('name', 'id')->all())
                            ->searchable()
                            ->required(),
                    ])
                    ->fillForm(fn (DeliveryNote $record): array => ['state_id' => $record->state_id])
                    ->action(function (DeliveryNote $record, array $data, Action $action): void {
                        app(DeliveryNoteWorkflow::class)->update($record, [
                            'state_id' => $data['state_id'],
                        ]);

                        $action->success();
                    })
                    ->successNotificationTitle('Estado actualizado'),
                EditAction::make(),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ]);
    }

    private static function stateColor(?string $state): string
    {
        $state = mb_strtolower($state ?? '');

        return match (true) {
            str_contains($state, 'taller') => 'info',
            str_contains($state, 'salida'), str_contains($state, 'técnico') => 'warning',
            str_contains($state, 'repar') => 'primary',
            str_contains($state, 'roto'), str_contains($state, 'aver') => 'danger',
            str_contains($state, 'elimin'), str_contains($state, 'baja') => 'gray',
            default => 'success',
        };
    }
}
