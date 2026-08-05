<?php

namespace App\Services;

use App\Exceptions\PrometeoSyncException;
use App\Models\PrometeoSyncRun;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class PrometeoSyncService
{
    private const LOCK_NAME = 'prometeo:sync';

    private const ALLOWED_MACHINE_TYPES = ['parent', 'roulette', 'single', 'AADD'];

    public function synchronize(?User $user = null): PrometeoSyncRun
    {
        $lock = Cache::lock(self::LOCK_NAME, 300);

        if (! $lock->get()) {
            throw new PrometeoSyncException('Ya hay una sincronización con Prometeo en curso.');
        }

        $run = PrometeoSyncRun::create([
            'user_id' => $user?->getKey(),
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            $snapshot = $this->readSnapshot();
            $this->validateSnapshot($snapshot);

            $counts = DB::transaction(fn (): array => $this->applySnapshot($snapshot));

            $run->update([
                'status' => 'success',
                'counts' => $counts,
                'finished_at' => now(),
            ]);

            return $run->refresh();
        } catch (Throwable $exception) {
            $safeMessage = $exception instanceof PrometeoSyncException
                ? $exception->getMessage()
                : 'No se pudo completar la sincronización con Prometeo.';

            $run->update([
                'status' => 'failed',
                'error' => $safeMessage,
                'finished_at' => now(),
            ]);

            Log::error('Falló la sincronización con Prometeo.', [
                'exception' => $exception::class,
                'code' => $exception->getCode(),
                'sync_run_id' => $run->getKey(),
            ]);

            throw new PrometeoSyncException($safeMessage);
        } finally {
            $lock->release();
        }
    }

    private function readSnapshot(): array
    {
        $connection = DB::connection('prometeo');

        return [
            'locals' => $connection->table('locals')
                ->select(['id', 'name', 'dbconection', 'idMachines', 'created_at', 'updated_at'])
                ->orderBy('id')
                ->get(),
            'bars' => $connection->table('bars')
                ->select(['id', 'name', 'holder', 'dni_cif', 'address', 'town', 'created_at', 'updated_at'])
                ->orderBy('id')
                ->get(),
            'machines' => $connection->table('machines')
                ->select([
                    'id',
                    'name',
                    'alias',
                    'local_id',
                    'bar_id',
                    'identificador',
                    'type',
                    'parent_id',
                    'created_at',
                    'updated_at',
                ])
                ->orderBy('id')
                ->get(),
        ];
    }

    private function validateSnapshot(array $snapshot): void
    {
        /** @var Collection<int, object> $locals */
        $locals = $snapshot['locals'];
        /** @var Collection<int, object> $bars */
        $bars = $snapshot['bars'];
        /** @var Collection<int, object> $machines */
        $machines = $snapshot['machines'];

        if ($locals->isEmpty() || $bars->isEmpty() || $machines->isEmpty()) {
            throw new PrometeoSyncException('Prometeo devolvió un catálogo vacío; no se aplicó ningún cambio.');
        }

        $localIds = $locals->pluck('id')->mapWithKeys(fn ($id): array => [(string) $id => true]);
        $barIds = $bars->pluck('id')->mapWithKeys(fn ($id): array => [(string) $id => true]);
        $machinesById = $machines->keyBy(fn ($machine): string => (string) $machine->id);

        foreach ($machines as $machine) {
            $hasLocal = $machine->local_id !== null;
            $hasBar = $machine->bar_id !== null;

            if ($hasLocal === $hasBar) {
                throw new PrometeoSyncException('Prometeo contiene una máquina con una ubicación incoherente.');
            }

            if ($hasLocal && ! $localIds->has((string) $machine->local_id)) {
                throw new PrometeoSyncException('Prometeo contiene una máquina asociada a un local inexistente.');
            }

            if ($hasBar && ! $barIds->has((string) $machine->bar_id)) {
                throw new PrometeoSyncException('Prometeo contiene una máquina asociada a un bar inexistente.');
            }

            if ($machine->type !== null && ! in_array($machine->type, self::ALLOWED_MACHINE_TYPES, true)) {
                throw new PrometeoSyncException('Prometeo contiene un tipo de máquina no compatible.');
            }

            if ($machine->parent_id === null) {
                continue;
            }

            $parent = $machinesById->get((string) $machine->parent_id);

            if ($parent === null) {
                throw new PrometeoSyncException('Prometeo contiene una máquina padre inexistente.');
            }

            if ($parent->local_id !== $machine->local_id || $parent->bar_id !== $machine->bar_id) {
                throw new PrometeoSyncException('Prometeo contiene máquinas padre e hijas en ubicaciones diferentes.');
            }
        }

        $this->assertMachineHierarchyHasNoCycles($machinesById);
    }

    private function assertMachineHierarchyHasNoCycles(Collection $machinesById): void
    {
        foreach ($machinesById as $machine) {
            $visited = [];
            $current = $machine;

            while ($current->parent_id !== null) {
                $currentId = (string) $current->id;

                if (isset($visited[$currentId])) {
                    throw new PrometeoSyncException('Prometeo contiene un ciclo en la jerarquía de máquinas.');
                }

                $visited[$currentId] = true;
                $current = $machinesById->get((string) $current->parent_id);
            }
        }
    }

    private function applySnapshot(array $snapshot): array
    {
        $now = now();

        $locals = $snapshot['locals']->map(fn ($local): array => [
            'id' => $local->id,
            'name' => $local->name,
            'dbconection' => $local->dbconection,
            'idMachines' => $local->idMachines,
            'is_active' => true,
            'synced_at' => $now,
            'created_at' => $local->created_at,
            'updated_at' => $local->updated_at,
        ]);

        $bars = $snapshot['bars']->map(fn ($bar): array => [
            'id' => $bar->id,
            'name' => $bar->name,
            'holder' => $bar->holder,
            'dni_cif' => $bar->dni_cif,
            'address' => $bar->address,
            'town' => $bar->town,
            'is_active' => true,
            'synced_at' => $now,
            'created_at' => $bar->created_at,
            'updated_at' => $bar->updated_at,
        ]);

        $machines = $snapshot['machines']->map(fn ($machine): array => [
            'id' => $machine->id,
            'name' => $machine->name,
            'alias' => $machine->alias,
            'local_id' => $machine->local_id,
            'bar_id' => $machine->bar_id,
            'identificador' => $machine->identificador,
            'type' => $machine->type,
            'parent_id' => $machine->parent_id,
            'is_active' => true,
            'synced_at' => $now,
            'created_at' => $machine->created_at,
            'updated_at' => $machine->updated_at,
        ]);

        $counts = [];
        $counts['locals'] = $this->synchronizeTable(
            'locals',
            $locals,
            ['name', 'dbconection', 'idMachines', 'is_active'],
            ['name', 'dbconection', 'idMachines', 'is_active', 'synced_at', 'updated_at'],
            $now,
        );
        $counts['bars'] = $this->synchronizeTable(
            'bars',
            $bars,
            ['name', 'holder', 'dni_cif', 'address', 'town', 'is_active'],
            ['name', 'holder', 'dni_cif', 'address', 'town', 'is_active', 'synced_at', 'updated_at'],
            $now,
        );

        $machinesWithoutParents = $machines->map(fn (array $machine): array => [
            ...$machine,
            'parent_id' => null,
        ]);

        $counts['machines'] = $this->synchronizeTable(
            'machines',
            $machines,
            ['name', 'alias', 'local_id', 'bar_id', 'identificador', 'type', 'parent_id', 'is_active'],
            ['name', 'alias', 'local_id', 'bar_id', 'identificador', 'type', 'parent_id', 'is_active', 'synced_at', 'updated_at'],
            $now,
            $machinesWithoutParents,
        );

        $this->upsertInChunks('machines', $machines, ['parent_id']);

        return $counts;
    }

    private function synchronizeTable(
        string $table,
        Collection $finalRows,
        array $comparisonColumns,
        array $updateColumns,
        mixed $syncedAt,
        ?Collection $initialRows = null,
    ): array {
        $existing = DB::table($table)->get()->keyBy(fn ($row): string => (string) $row->id);
        $created = 0;
        $updated = 0;

        foreach ($finalRows as $row) {
            $current = $existing->get((string) $row['id']);

            if ($current === null) {
                $created++;

                continue;
            }

            if ($this->rowHasChanges($current, $row, $comparisonColumns)) {
                $updated++;
            }
        }

        $sourceIds = $finalRows->pluck('id')->all();
        $inactivated = DB::table($table)
            ->where('is_active', true)
            ->whereNotIn('id', $sourceIds)
            ->update([
                'is_active' => false,
                'synced_at' => $syncedAt,
            ]);

        $this->upsertInChunks($table, $initialRows ?? $finalRows, $updateColumns);

        return [
            'source' => $finalRows->count(),
            'created' => $created,
            'updated' => $updated,
            'unchanged' => $finalRows->count() - $created - $updated,
            'inactivated' => $inactivated,
        ];
    }

    private function upsertInChunks(string $table, Collection $rows, array $updateColumns): void
    {
        $rows->chunk(500)->each(function (Collection $chunk) use ($table, $updateColumns): void {
            DB::table($table)->upsert($chunk->all(), ['id'], $updateColumns);
        });
    }

    private function rowHasChanges(object $current, array $incoming, array $columns): bool
    {
        foreach ($columns as $column) {
            if ($column === 'dbconection') {
                if (json_decode($current->{$column}, true) != json_decode($incoming[$column], true)) {
                    return true;
                }

                continue;
            }

            if ((string) ($current->{$column} ?? '') !== (string) ($incoming[$column] ?? '')) {
                return true;
            }
        }

        return false;
    }
}
