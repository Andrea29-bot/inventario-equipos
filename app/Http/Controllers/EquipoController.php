<?php

namespace App\Http\Controllers;
use App\Models\Equipo;

use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $equipos = Equipo::orderBy('created_at', 'desc')->get();

    return view('equipos.index', compact('equipos'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('equipos.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $datos = $request->validate([
        'nombre'    => 'required|string|max:100',
        'tipo'      => 'required|string|max:60',
        'marca'     => 'nullable|string|max:60',
        'estado'    => 'required|in:disponible,en_uso,mantenimiento',
        'ubicacion' => 'nullable|string|max:100',
    ]);

    Equipo::create($datos);

    return redirect()
        ->route('equipos.index')
        ->with('exito', 'Equipo registrado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
{
    return view('equipos.edit', compact('equipo'));
}

public function update(Request $request, Equipo $equipo)
{
    $datos = $request->validate([
        'nombre'    => 'required|string|max:100',
        'tipo'      => 'required|string|max:60',
        'marca'     => 'nullable|string|max:60',
        'estado'    => 'required|in:disponible,en_uso,mantenimiento',
        'ubicacion' => 'nullable|string|max:100',
    ]);

    $equipo->update($datos);

    return redirect()
        ->route('equipos.index')
        ->with('exito', 'Equipo actualizado correctamente.');
}

public function destroy(Equipo $equipo)
{
    $equipo->delete();

    return redirect()
        ->route('equipos.index')
        ->with('exito', 'Equipo eliminado.');
}
public function marcarUrgente(Equipo $equipo)
{
    $equipo->update(['urgente' => ! $equipo->urgente]);

    return redirect()->route('equipos.index');
}
}
