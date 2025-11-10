<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FactoryController extends Controller
{
    public function index()
    {
        $factories = Factory::orderBy('name')->paginate(10);;
        return view('factories.index', compact('factories'));
    }

    public function create()
    {
        return view('factories.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city'    => ['required', 'string', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'email'   => ['required', 'email', 'max:255', 'unique:factories,email'],
            'cif'     => ['required', 'string', 'max:20', 'unique:factories,cif'],
        ]);

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
        dd($request->all());

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city'    => ['required', 'string', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'email'   => [
                'required',
                'email',
                'max:255',
                Rule::unique('factories', 'email')->ignore($factory->id),
            ],
            'cif'     => [
                'required',
                'string',
                'max:20',
                Rule::unique('factories', 'cif')->ignore($factory->id),
            ],
        ]);

        $factory->update($validated);

        return redirect()
            ->route('factories.index')
            ->with('status', 'Fábrica actualizada correctamente.');
    }

    public function destroy(Factory $factory)
    {
        //dd($factory);

        $factory->delete();
        return redirect()->route('factories.index')->with('status', 'Fábrica eliminada correctamente.');
    }
}
