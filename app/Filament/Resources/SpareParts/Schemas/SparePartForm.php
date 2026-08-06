<?php

namespace App\Filament\Resources\SpareParts\Schemas;

use App\Support\Validation\WorkshopRules;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SparePartForm
{
    public static function configure(Schema $schema): Schema
    {
        $rules = WorkshopRules::sparePart();

        return $schema
            ->components([
                Section::make('Datos del repuesto')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->rules($rules['name'])
                            ->columnSpanFull(),
                        Select::make('factory_id')
                            ->label('Fabricante')
                            ->relationship('factory', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rules($rules['factory_id']),
                        Select::make('state_id')
                            ->label('Estado')
                            ->relationship('state', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rules($rules['state_id']),
                    ])
                    ->columns(2),
            ]);
    }
}
