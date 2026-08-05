<?php

namespace App\Filament\Widgets;

use App\Models\State;
use Filament\Widgets\ChartWidget;

class SparePartsByState extends ChartWidget
{
    protected static ?int $sort = 30;

    protected ?string $heading = 'Repuestos por estado';

    protected ?string $description = 'Situación actual del inventario de repuestos.';

    protected ?string $maxHeight = '300px';

    public function getStateCounts(): array
    {
        return State::query()
            ->withCount('spareParts')
            ->orderBy('name')
            ->pluck('spare_parts_count', 'name')
            ->map(fn (int $count): int => $count)
            ->all();
    }

    protected function getData(): array
    {
        $counts = $this->getStateCounts();

        return [
            'datasets' => [
                [
                    'label' => 'Repuestos',
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
