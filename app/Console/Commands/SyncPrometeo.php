<?php

namespace App\Console\Commands;

use App\Exceptions\PrometeoSyncException;
use App\Services\PrometeoSyncService;
use Illuminate\Console\Command;

class SyncPrometeo extends Command
{
    protected $signature = 'prometeo:sync';

    protected $description = 'Sincroniza locales, bares y máquinas desde Prometeo';

    public function handle(PrometeoSyncService $service): int
    {
        $this->info('Sincronizando los catálogos de Prometeo...');

        try {
            $run = $service->synchronize();
        } catch (PrometeoSyncException $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $rows = collect($run->counts)->map(fn (array $counts, string $catalog): array => [
            ucfirst($catalog),
            $counts['source'],
            $counts['created'],
            $counts['updated'],
            $counts['unchanged'],
            $counts['inactivated'],
        ])->values()->all();

        $this->table(
            ['Catálogo', 'Origen', 'Creados', 'Actualizados', 'Sin cambios', 'Inactivados'],
            $rows,
        );
        $this->info('Sincronización completada correctamente.');

        return self::SUCCESS;
    }
}
