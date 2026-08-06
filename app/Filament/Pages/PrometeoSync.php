<?php

namespace App\Filament\Pages;

use App\Exceptions\PrometeoSyncException;
use App\Models\PrometeoSyncRun;
use App\Services\PrometeoSyncService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class PrometeoSync extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static string|UnitEnum|null $navigationGroup = 'Prometeo';

    protected static ?string $navigationLabel = 'Sincronización';

    protected static ?string $title = 'Sincronización con Prometeo';

    protected static ?string $slug = 'prometeo-sync';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.prometeo-sync';

    public function getLastRun(): ?PrometeoSyncRun
    {
        return PrometeoSyncRun::query()->with('user:id,name')->latest('id')->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('synchronize')
                ->label('Sincronizar con Prometeo')
                ->icon(Heroicon::OutlinedArrowPath)
                ->requiresConfirmation()
                ->modalHeading('Sincronizar catálogos')
                ->modalDescription('Prometeo sobrescribirá los datos locales de locales, bares y máquinas. Los registros ausentes se marcarán como inactivos.')
                ->action(function (): void {
                    try {
                        $run = app(PrometeoSyncService::class)->synchronize(auth()->user());
                    } catch (PrometeoSyncException $exception) {
                        Notification::make()
                            ->title('No se pudo sincronizar')
                            ->body($exception->getMessage())
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title('Sincronización completada')
                        ->body($this->summarizeCounts($run->counts ?? []))
                        ->success()
                        ->send();
                }),
        ];
    }

    private function summarizeCounts(array $counts): string
    {
        $created = collect($counts)->sum('created');
        $updated = collect($counts)->sum('updated');
        $inactivated = collect($counts)->sum('inactivated');

        return "Creados: {$created}. Actualizados: {$updated}. Inactivados: {$inactivated}.";
    }
}
