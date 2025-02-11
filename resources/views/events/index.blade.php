@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Eventos</h1>
        <a href="{{ route('events.create') }}" 
           class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Crear Nuevo Evento
        </a>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('events.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="category" class="form-label">Categoría</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}"
                           class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="location" class="form-label">Ubicación</label>
                    <select name="location" id="location" class="form-select">
                        <option value="">Todas las ubicaciones</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                                {{ $location->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($events as $event)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($event->imagen)
                        <img src="{{ asset('storage/' . $event->imagen) }}" 
                             alt="{{ $event->nombre }}" 
                             class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->nombre }}</h5>
                        <p class="card-text text-muted mb-2">{{ Str::limit($event->descripcion, 100) }}</p>
                        
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-calendar me-2 text-primary"></i>
                            <small>{{ $event->fecha->format('d/m/Y') }}</small>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <small>{{ $event->ubicacion->nombre }}</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge {{ $event->estado === 'programado' ? 'bg-success' : 
                                              ($event->estado === 'cancelado' ? 'bg-danger' : 'bg-primary') }}">
                                {{ ucfirst($event->estado) }}
                            </span>
                            <a href="{{ route('events.show', $event) }}" 
                               class="btn btn-outline-primary btn-sm">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hay eventos disponibles
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
</div>

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Estilos para la paginación */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-item.active .page-link {
        background-color: #64B5F6;
        border-color: #64B5F6;
    }
    
    .page-link {
        color: #64B5F6;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin: 0 0.2rem;
    }
    
    .page-link:hover {
        color: #1976D2;
        background-color: #E3F2FD;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
    }
</style>
@endpush
@endsection