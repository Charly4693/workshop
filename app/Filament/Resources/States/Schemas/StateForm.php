<?php

namespace App\Filament\Resources\States\Schemas;

use App\Models\State;
use App\Support\Validation\WorkshopRules;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->rules(fn (?State $record): array => WorkshopRules::state($record)['name'])
                    ->autofocus(),
            ]);
    }
}
