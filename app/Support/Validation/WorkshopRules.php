<?php

namespace App\Support\Validation;

use App\Models\Factory;
use App\Models\Machine;
use App\Models\State;
use Illuminate\Validation\Rule;

final class WorkshopRules
{
    public static function state(?State $state = null): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('states', 'name')->ignore($state),
            ],
        ];
    }

    public static function factory(?Factory $factory = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('factories', 'email')->ignore($factory),
            ],
            'cif' => [
                'required',
                'string',
                'max:20',
                Rule::unique('factories', 'cif')->ignore($factory),
            ],
        ];
    }

    public static function sparePart(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'factory_id' => ['required', 'exists:factories,id'],
            'state_id' => ['required', 'exists:states,id'],
        ];
    }

    public static function deliveryNote(): array
    {
        return [
            'spare_part_id' => ['nullable', 'exists:spare_parts,id'],
            'state_id' => ['nullable', 'exists:states,id'],
            'local_id' => ['nullable', 'exists:locals,id'],
            'bar_id' => ['nullable', 'exists:bars,id'],
            'machine_id' => ['nullable', 'exists:machines,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public static function machine(?Machine $machine = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'alias' => ['required', 'string', 'max:255'],
            'identificador' => ['required', 'string', 'max:255'],
            'type' => ['nullable', Rule::in(['parent', 'roulette', 'single'])],
            'local_id' => ['nullable', 'required_without:bar_id', 'prohibits:bar_id', 'exists:locals,id'],
            'bar_id' => ['nullable', 'required_without:local_id', 'prohibits:local_id', 'exists:bars,id'],
            'parent_id' => [
                'nullable',
                'exists:machines,id',
                Rule::notIn(array_filter([$machine?->getKey()])),
            ],
        ];
    }
}
