<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Support\Validation\WorkshopRules;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Factory::class, 'factory');
    }

    public function index()
    {
        $factories = Factory::orderBy('name')->paginate(10);

        return view('factories.index', compact('factories'));
    }

    public function create()
    {
        return view('factories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(WorkshopRules::factory());

        Factory::create($validated);

        return redirect()
            ->route('factories.index')
            ->with('status', 'Fábrica creada correctamente.');
    }

    public function edit(Factory $factory)
    {
        return view('factories.edit', compact('factory'));
    }

    public function update(Request $request, Factory $factory)
    {
        $validated = $request->validate(WorkshopRules::factory($factory));

        $factory->update($validated);

        return redirect()
            ->route('factories.index')
            ->with('status', 'Fábrica actualizada correctamente.');
    }

    public function destroy(Factory $factory)
    {
        $factory->delete();

        return redirect()->route('factories.index')->with('status', 'Fábrica eliminada correctamente.');
    }
}
