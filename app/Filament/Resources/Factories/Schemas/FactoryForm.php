<?php

namespace App\Filament\Resources\Factories\Schemas;

use App\Models\Factory;
use App\Support\Validation\WorkshopRules;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FactoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del fabricante')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['name'])
                            ->columnSpanFull(),
                        TextInput::make('address')
                            ->label('Dirección')
                            ->required()
                            ->maxLength(255)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['address'])
                            ->columnSpanFull(),
                        TextInput::make('city')
                            ->label('Ciudad')
                            ->required()
                            ->maxLength(100)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['city']),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(50)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['phone']),
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['email']),
                        TextInput::make('cif')
                            ->label('CIF')
                            ->required()
                            ->maxLength(20)
                            ->rules(fn (?Factory $record): array => WorkshopRules::factory($record)['cif']),
                    ])
                    ->columns(2),
            ]);
    }
}
