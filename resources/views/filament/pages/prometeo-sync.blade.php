<x-filament-panels::page>
    @php($lastRun = $this->getLastRun())

    <x-filament::section>
        <x-slot name="heading">Sincronización manual</x-slot>
        <x-slot name="description">
            Prometeo es la fuente de verdad. Workshop solo lee sus catálogos y actualiza su copia local.
        </x-slot>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Usa el botón superior cuando necesites actualizar locales, bares y máquinas. No se ejecutan sincronizaciones automáticas.
        </p>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Última ejecución</x-slot>

        @if ($lastRun)
            <div class="grid gap-4 md:grid-cols-4">
                <div>
                    <div class="text-sm text-gray-500">Estado</div>
                    <x-filament::badge :color="$lastRun->status === 'success' ? 'success' : ($lastRun->status === 'running' ? 'warning' : 'danger')">
                        {{ match ($lastRun->status) {
                            'success' => 'Completada',
                            'running' => 'En curso',
                            default => 'Fallida',
                        } }}
                    </x-filament::badge>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Iniciada</div>
                    <div>{{ $lastRun->started_at?->format('d/m/Y H:i:s') }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Ejecutada por</div>
                    <div>{{ $lastRun->user?->name ?? 'Consola' }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Duración</div>
                    <div>
                        {{ $lastRun->finished_at
                            ? number_format($lastRun->started_at->diffInMilliseconds($lastRun->finished_at) / 1000, 2, ',', '.') . ' s'
                            : '—' }}
                    </div>
                </div>
            </div>

            @if ($lastRun->counts)
                <div style="margin-top: 1.5rem; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                        <thead>
                            <tr>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219);">Catálogo</th>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">Origen</th>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">Creados</th>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">Actualizados</th>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">Sin cambios</th>
                                <th style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">Inactivados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['locals' => 'Locales', 'bars' => 'Bares', 'machines' => 'Máquinas'] as $key => $label)
                                @php($counts = $lastRun->counts[$key] ?? [])
                                <tr>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); font-weight: 500;">{{ $label }}</td>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">{{ $counts['source'] ?? 0 }}</td>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">{{ $counts['created'] ?? 0 }}</td>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">{{ $counts['updated'] ?? 0 }}</td>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">{{ $counts['unchanged'] ?? 0 }}</td>
                                    <td style="padding: 0.75rem; border: 1px solid rgb(209 213 219); text-align: right;">{{ $counts['inactivated'] ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($lastRun->error)
                <p class="mt-4 text-sm text-danger-600">{{ $lastRun->error }}</p>
            @endif
        @else
            <p class="text-sm text-gray-600 dark:text-gray-400">Todavía no se ha ejecutado ninguna sincronización.</p>
        @endif
    </x-filament::section>
</x-filament-panels::page>
