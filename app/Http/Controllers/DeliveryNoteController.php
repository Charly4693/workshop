<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Local;
use App\Models\Machine;
use App\Models\SparePart;
use App\Models\State;
use App\Models\User;
use App\Models\DeliveryNote;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{
    public function index()
    {
        // Eager loading para evitar N+1
        $deliverynotes = DeliveryNote::with([
            'sparepart:id,name',
            'state:id,name',
            'user:id,name',
            'local:id,name',
            'bar:id,name',
            'machine:id,alias',
        ])->latest() // por fecha de creación
        ->paginate(10);

        return view('deliverynotes.index', compact('deliverynotes'));
    }

    public function create()
    {
        $spareparts = SparePart::orderBy('name')->get(['id', 'name']);
        $states     = State::orderBy('name')->get(['id', 'name']);
        $locals     = Local::orderBy('name')->get(['id', 'name']);
        $bars       = Bar::orderBy('name')->get(['id', 'name']);
        $machines   = Machine::orderBy('alias')->get(['id', 'alias as name']); // alias como name para el select
        $users      = User::orderBy('name')->get(['id', 'name']);

        return view('deliverynotes.create', compact(
            'spareparts',
            'states',
            'locals',
            'bars',
            'machines',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'spare_part_id' => ['nullable', 'exists:spare_parts,id'],
            'state_id'      => ['nullable', 'exists:states,id'],
            'local_id'      => ['nullable', 'exists:locals,id'],
            'bar_id'        => ['nullable', 'exists:bars,id'],
            'machine_id'    => ['nullable', 'exists:machines,id'],
            'user_id'       => ['nullable', 'exists:users,id'],
            'comment'       => ['nullable', 'string', 'max:2000'],
        ]);

        DeliveryNote::create($data);

        return redirect()
            ->route('deliverynotes.index')
            ->with('status', 'Pedido creado correctamente.');
    }

    public function edit(DeliveryNote $deliverynote)
    {
        $spareparts = SparePart::orderBy('name')->get(['id', 'name']);
        $states     = State::orderBy('name')->get(['id', 'name']);
        $locals     = Local::orderBy('name')->get(['id', 'name']);
        $bars       = Bar::orderBy('name')->get(['id', 'name']);
        $machines   = Machine::orderBy('alias')->get(['id', 'alias as name']);
        $users      = User::orderBy('name')->get(['id', 'name']);

        return view('deliverynotes.edit', compact(
            'deliverynote',
            'spareparts',
            'states',
            'locals',
            'bars',
            'machines',
            'users'
        ));
    }

    public function update(Request $request, DeliveryNote $deliverynote)
    {
        $data = $request->validate([
            'spare_part_id' => ['nullable', 'exists:spare_parts,id'],
            'state_id'      => ['nullable', 'exists:states,id'],
            'local_id'      => ['nullable', 'exists:locals,id'],
            'bar_id'        => ['nullable', 'exists:bars,id'],
            'machine_id'    => ['nullable', 'exists:machines,id'],
            'user_id'       => ['nullable', 'exists:users,id'],
            'comment'       => ['nullable', 'string', 'max:2000'],
        ]);

        $deliverynote->update($data);

        return redirect()
            ->route('deliverynotes.index')
            ->with('status', 'Pedido actualizado correctamente.');
    }

    public function destroy(DeliveryNote $deliverynote)
    {
        $deliverynote->delete();

        return redirect()
            ->route('deliverynotes.index')
            ->with('status', 'Pedido eliminado correctamente.');
    }
}
