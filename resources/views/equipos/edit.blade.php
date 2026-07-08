@extends('layouts.app')

@section('titulo', 'Editar Equipo')

@section('contenido')
    <h1 class="h3 mb-3">Editar equipo</h1>

    <form action="{{ route('equipos.update', $equipo) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre', $equipo->nombre) }}" required maxlength="100">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control"
                   value="{{ old('tipo', $equipo->tipo) }}" required maxlength="60">
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control"
                   value="{{ old('marca', $equipo->marca) }}" maxlength="60">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="disponible" {{ old('estado', $equipo->estado) === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="en_uso" {{ old('estado', $equipo->estado) === 'en_uso' ? 'selected' : '' }}>En uso</option>
                <option value="mantenimiento" {{ old('estado', $equipo->estado) === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control"
                   value="{{ old('ubicacion', $equipo->ubicacion) }}" maxlength="100">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('equipos.index') }}" class="btn btn-link">Cancelar</a>
    </form>
@endsection
