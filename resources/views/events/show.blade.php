
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Botón de regreso -->
            <div class="mb-4">
                <a href="{{ route('events.index') }}" 
                   class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver a Eventos
                </a>
            </div>

            <!-- Imagen del evento -->
            @if($event->imagen)
                <div class="card mb-4 shadow">
                    <img src="{{ asset('storage/' . $event->imagen) }}" 
                         alt="{{ $event->nombre }}" 
                         class="card-img-top" style="height: 300px; object-fit: cover;">
                </div>
            @endif

            <!-- Información principal -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h2 mb-2">{{ $event->nombre }}</h1>
                            <span class="badge {{ $event->estado === 'programado' ? 'bg-success' : 
                                              ($event->estado === 'cancelado' ? 'bg-danger' : 'bg-primary') }}">
                                {{ ucfirst($event->estado) }}
                            </span>
                        </div>

                        @if($event->estado === 'programado')
                            <div class="btn-group">
                                <a href="{{ route('events.edit', $event) }}" 
                                   class="btn btn-primary">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ms-2"
                                            onclick="return confirm('¿Estás seguro de querer eliminar este evento?')">
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4 class="text-primary mb-3">Detalles del Evento</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="far fa-calendar me-2 text-primary"></i>
                                    {{ $event->fecha->format('d/m/Y') }}
                                </li>
                                <li class="mb-2">
                                    <i class="far fa-clock me-2 text-primary"></i>
                                    {{ $event->hora_inicio }} - {{ $event->hora_fin }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                    {{ $event->ubicacion->nombre }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users me-2 text-primary"></i>
                                    Capacidad: {{ $event->capacidad ?? 'Sin límite' }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-primary mb-3">Descripción</h4>
                            <p class="text-muted">{{ $event->descripcion }}</p>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-location-dot me-2"></i>Ubicación
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Dirección:</strong> {{ $event->ubicacion->direccion }}</p>
                                    <p class="mb-1"><strong>Ciudad:</strong> {{ $event->ubicacion->ciudad }}</p>
                                    <p class="mb-1"><strong>Estado:</strong> {{ $event->ubicacion->estado }}</p>
                                    <p class="mb-0"><strong>CP:</strong> {{ $event->ubicacion->codigo_postal }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded" style="height: 200px;">
                                        <!-- Aquí puedes agregar un mapa si lo deseas -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@endsection