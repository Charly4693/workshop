<x-filament-widgets::widget>
    <style>
        .fi-state-delivery-content {
            height: 32rem;
            overflow-y: auto;
            padding-right: 0.25rem;
        }

        .fi-state-delivery-table-wrapper {
            overflow-x: auto;
        }

        .fi-state-delivery-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
        }

        .fi-state-delivery-table th,
        .fi-state-delivery-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgb(229 231 235);
            vertical-align: top;
        }

        .dark .fi-state-delivery-table th,
        .dark .fi-state-delivery-table td {
            border-bottom-color: rgb(55 65 81);
        }

        .fi-state-delivery-table th {
            font-weight: 600;
        }

        .fi-state-delivery-link {
            color: #3a53cd;
            font-weight: 500;
            text-decoration: none;
        }

        .dark .fi-state-delivery-link {
            color: #b4c0fd;
        }

        .fi-state-delivery-link:hover {
            text-decoration: underline;
        }

        .fi-state-delivery-empty {
            padding: 2rem 0.75rem;
            text-align: center;
            color: rgb(107 114 128);
        }

        .fi-state-delivery-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>

    <x-filament::section>
        <x-slot name="heading">Albaranes por estado</x-slot>
        <x-slot name="description">
            Selecciona un estado para consultar sus albaranes.
        </x-slot>

        <div class="fi-state-delivery-content">
            @if ($this->states->isEmpty())
                <p class="fi-state-delivery-empty">Todavía no hay estados configurados.</p>
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

                <x-filament::section style="margin-top: 1.5rem;">
                    <x-slot name="heading">Albaranes ({{ $this->deliveryNotes->total() }})</x-slot>

                    <div class="fi-state-delivery-table-wrapper">
                        <table class="fi-state-delivery-table">
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
                                                class="fi-state-delivery-link"
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
                                        <td colspan="5" class="fi-state-delivery-empty">No hay albaranes en este estado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($this->deliveryNotes->hasPages())
                        <div class="fi-state-delivery-pagination">
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
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
