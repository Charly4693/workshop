<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\SparePart;
use App\Models\State;
use App\Support\Validation\WorkshopRules;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SparePart::class, 'sparepart');
    }

    public function index()
    {
        // Traemos fábrica y estado para no hacer N+1
        $spareparts = SparePart::with(['factory:id,name', 'state:id,name'])
            ->orderBy('name')
            ->paginate(10);

        return view('spareparts.index', compact('spareparts'));
    }

    public function create()
    {
        $factories = Factory::orderBy('name')->get(['id', 'name']);
        $states = State::orderBy('name')->get(['id', 'name']);

        return view('spareparts.create', compact('factories', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(WorkshopRules::sparePart());

        SparePart::create($validated);

        return redirect()
            ->route('spareparts.index')
            ->with('status', 'Repuesto creado correctamente.');
    }

    public function edit(SparePart $sparepart)
    {
        $factories = Factory::orderBy('name')->get(['id', 'name']);
        $states = State::orderBy('name')->get(['id', 'name']);

        return view('spareparts.edit', compact('sparepart', 'factories', 'states'));
    }

    public function update(Request $request, SparePart $sparepart)
    {
        $validated = $request->validate(WorkshopRules::sparePart());

        $sparepart->update($validated);

        return redirect()
            ->route('spareparts.index')
            ->with('status', 'Repuesto actualizado correctamente.');
    }

    public function destroy(SparePart $sparepart)
    {
        $sparepart->delete();

        return redirect()
            ->route('spareparts.index')
            ->with('status', 'Repuesto eliminado correctamente.');
    }
}
