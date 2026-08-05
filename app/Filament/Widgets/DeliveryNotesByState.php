<?php

namespace App\Filament\Widgets;

use App\Models\DeliveryNote;
use App\Models\State;
use Filament\Widgets\ChartWidget;

class DeliveryNotesByState extends ChartWidget
{
    protected static ?int $sort = 20;

    protected ?string $heading = 'Albaranes por estado';

    protected ?string $description = 'Distribución actual de todos los albaranes.';

    protected ?string $maxHeight = '300px';

    public function getStateCounts(): array
    {
        $counts = State::query()
            ->withCount('deliveryNotes')
            ->orderBy('name')
            ->pluck('delivery_notes_count', 'name')
            ->map(fn (int $count): int => $count)
            ->all();

        $withoutState = DeliveryNote::query()->whereNull('state_id')->count();

        if ($withoutState > 0) {
            $counts['Sin estado'] = $withoutState;
        }

        return $counts;
    }

    protected function getData(): array
    {
        $counts = $this->getStateCounts();

        return [
            'datasets' => [
                [
                    'label' => 'Albaranes',
                    'data' => array_values($counts),
                    'backgroundColor' => $this->chartColors(count($counts)),
                    'borderWidth' => 0,
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    private function chartColors(int $count): array
    {
        $palette = ['#6366f1', '#0ea5e9', '#14b8a6', '#f59e0b', '#ef4444', '#8b5cf6', '#64748b'];

        return collect(range(0, max(0, $count - 1)))
            ->map(fn (int $index): string => $palette[$index % count($palette)])
            ->take($count)
            ->all();
    }
}
