<?php

namespace App\Filament\Resources\DeliveryNotes\Schemas;

use App\Models\Machine;
use App\Support\Validation\WorkshopRules;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class DeliveryNoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Entrega')
                    ->description('Selecciona la pieza, su estado y el técnico que la recibe.')
                    ->schema([
                        Select::make('spare_part_id')
                            ->label('Repuesto')
                            ->relationship('sparepart', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rules(WorkshopRules::deliveryNote()['spare_part_id']),
                        Select::make('state_id')
                            ->label('Estado de la pieza')
                            ->relationship('state', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rules(WorkshopRules::deliveryNote()['state_id']),
                        Select::make('user_id')
                            ->label('Técnico receptor')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rules(WorkshopRules::deliveryNote()['user_id'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Destino')
                    ->description('Elige un local o un bar; las máquinas se filtrarán por esa ubicación.')
                    ->schema([
                        Select::make('local_id')
                            ->label('Local')
                            ->relationship('local', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->requiredWithout('bar_id')
                            ->prohibits('bar_id')
                            ->afterStateUpdated(function (Set $set, mixed $state): void {
                                if (filled($state)) {
                                    $set('bar_id', null);
                                }

                                $set('machine_id', null);
                            })
                            ->rules(['exists:locals,id']),
                        Select::make('bar_id')
                            ->label('Bar')
                            ->relationship('bar', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->requiredWithout('local_id')
                            ->prohibits('local_id')
                            ->afterStateUpdated(function (Set $set, mixed $state): void {
                                if (filled($state)) {
                                    $set('local_id', null);
                                }

                                $set('machine_id', null);
                            })
                            ->rules(['exists:bars,id']),
                        Select::make('machine_id')
                            ->label('Máquina')
                            ->options(fn (Get $get): array => self::machineOptions(
                                $get('local_id'),
                                $get('bar_id'),
                            ))
                            ->searchable()
                            ->required()
                            ->disabled(fn (Get $get): bool => ! self::hasOneLocation(
                                $get('local_id'),
                                $get('bar_id'),
                            ))
                            ->rules(fn (Get $get): array => WorkshopRules::deliveryNote(
                                $get('local_id'),
                                $get('bar_id'),
                            )['machine_id'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Observaciones')
                    ->schema([
                        Textarea::make('comment')
                            ->label('Comentario')
                            ->rows(4)
                            ->maxLength(2000)
                            ->rules(WorkshopRules::deliveryNote()['comment'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    private static function machineOptions(int|string|null $localId, int|string|null $barId): array
    {
        if (! self::hasOneLocation($localId, $barId)) {
            return [];
        }

        return Machine::query()
            ->when(
                filled($localId),
                fn ($query) => $query->where('local_id', $localId)->whereNull('bar_id'),
                fn ($query) => $query->where('bar_id', $barId)->whereNull('local_id'),
            )
            ->orderBy('alias')
            ->get(['id', 'alias', 'name'])
            ->mapWithKeys(fn (Machine $machine): array => [
                $machine->id => "{$machine->alias} — {$machine->name}",
            ])
            ->all();
    }

    private static function hasOneLocation(int|string|null $localId, int|string|null $barId): bool
    {
        return filled($localId) xor filled($barId);
    }
}
