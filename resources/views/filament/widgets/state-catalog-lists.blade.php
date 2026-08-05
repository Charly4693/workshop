<x-filament-widgets::widget>
    <style>
        .fi-state-catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 32rem), 1fr));
            gap: 1.5rem;
        }

        .fi-state-catalog-table-wrapper {
            overflow-x: auto;
        }

        .fi-state-catalog-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
        }

        .fi-state-catalog-table th,
        .fi-state-catalog-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgb(229 231 235);
            vertical-align: top;
        }

        .dark .fi-state-catalog-table th,
        .dark .fi-state-catalog-table td {
            border-bottom-color: rgb(55 65 81);
        }

        .fi-state-catalog-table th {
            font-weight: 600;
        }

        .fi-state-catalog-link {
            color: rgb(79 70 229);
            font-weight: 500;
            text-decoration: none;
        }

        .dark .fi-state-catalog-link {
            color: rgb(165 180 252);
        }

        .fi-state-catalog-link:hover {
            text-decoration: underline;
        }

        .fi-state-catalog-empty {
            padding: 2rem 0.75rem;
            text-align: center;
            color: rgb(107 114 128);
        }

        .fi-state-catalog-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>

    <x-filament::section>
        <x-slot name="heading">Albaranes y repuestos por estado</x-slot>
        <x-slot name="description">
            Selecciona un estado para consultar los registros asociados.
        </x-slot>

        @if ($this->states->isEmpty())
            <p class="fi-state-catalog-empty">Todavía no hay estados configurados.</p>
        @else
            <x-filament::tabs label="Estados">
                @foreach ($this->states as $state)
                    <x-filament::tabs.item
                        :active="$activeStateId === $state->id"
                        wire:click="selectState({{ $state->id }})"
                        wire:key="state-tab-{{ $state->id }}"
                    >
                        {{ $state->name }}
                    </x-filament::tabs.item>
                @endforeach
            </x-filament::tabs>

            <div class="fi-state-catalog-grid" style="margin-top: 1.5rem;">
                <x-filament::section>
                    <x-slot name="heading">Albaranes ({{ $this->deliveryNotes->total() }})</x-slot>

                    <div class="fi-state-catalog-table-wrapper">
                        <table class="fi-state-catalog-table">
                            <thead>
                                <tr>
                                    <th>Repuesto</th>
                                    <th>Técnico</th>
                                    <th>Ubicación</th>
                                    <th>Máquina</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->deliveryNotes as $deliveryNote)
                                    <tr wire:key="state-delivery-note-{{ $deliveryNote->id }}">
                                        <td>
                                            <a
                                                class="fi-state-catalog-link"
                                                href="{{ \App\Filament\Resources\DeliveryNotes\DeliveryNoteResource::getUrl('edit', ['record' => $deliveryNote]) }}"
                                                wire:navigate
                                            >
                                                {{ $deliveryNote->sparepart?->name ?? 'Repuesto eliminado' }}
                                            </a>
                                        </td>
                                        <td>{{ $deliveryNote->user?->name ?? 'Sin responsable' }}</td>
                                        <td>{{ $deliveryNote->local?->name ?? $deliveryNote->bar?->name ?? '—' }}</td>
                                        <td>{{ $deliveryNote->machine?->alias ?? '—' }}</td>
                                        <td>{{ $deliveryNote->created_at?->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="fi-state-catalog-empty">No hay albaranes en este estado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($this->deliveryNotes->hasPages())
                        <div class="fi-state-catalog-pagination">
                            <x-filament::button
                                color="gray"
                                size="sm"
                                wire:click="previousPage('deliveryNotesPage')"
                                :disabled="$this->deliveryNotes->onFirstPage()"
                            >
                                Anterior
                            </x-filament::button>

                            <span>Página {{ $this->deliveryNotes->currentPage() }} de {{ $this->deliveryNotes->lastPage() }}</span>

                            <x-filament::button
                                color="gray"
                                size="sm"
                                wire:click="nextPage('deliveryNotesPage')"
                                :disabled="! $this->deliveryNotes->hasMorePages()"
                            >
                                Siguiente
                            </x-filament::button>
                        </div>
                    @endif
                </x-filament::section>

                <x-filament::section>
                    <x-slot name="heading">Repuestos ({{ $this->spareParts->total() }})</x-slot>

                    <div class="fi-state-catalog-table-wrapper">
                        <table class="fi-state-catalog-table">
                            <thead>
                                <tr>
                                    <th>Repuesto</th>
                                    <th>Fabricante</th>
                                    <th>Actualizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->spareParts as $sparePart)
                                    <tr wire:key="state-spare-part-{{ $sparePart->id }}">
                                        <td>
                                            <a
                                                class="fi-state-catalog-link"
                                                href="{{ \App\Filament\Resources\SpareParts\SparePartResource::getUrl('edit', ['record' => $sparePart]) }}"
                                                wire:navigate
                                            >
                                                {{ $sparePart->name }}
                                            </a>
                                        </td>
                                        <td>{{ $sparePart->factory?->name ?? 'Fabricante eliminado' }}</td>
                                        <td>{{ $sparePart->updated_at?->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="fi-state-catalog-empty">No hay repuestos en este estado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($this->spareParts->hasPages())
                        <div class="fi-state-catalog-pagination">
                            <x-filament::button
                                color="gray"
                                size="sm"
                                wire:click="previousPage('sparePartsPage')"
                                :disabled="$this->spareParts->onFirstPage()"
                            >
                                Anterior
                            </x-filament::button>

                            <span>Página {{ $this->spareParts->currentPage() }} de {{ $this->spareParts->lastPage() }}</span>

                            <x-filament::button
                                color="gray"
                                size="sm"
                                wire:click="nextPage('sparePartsPage')"
                                :disabled="! $this->spareParts->hasMorePages()"
                            >
                                Siguiente
                            </x-filament::button>
                        </div>
                    @endif
                </x-filament::section>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
