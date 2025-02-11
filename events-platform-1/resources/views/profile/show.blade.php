
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 class="rounded-circle" alt="Avatar"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px; font-size: 4rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h4 class="card-title mb-0">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Editar Perfil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card shadow-lg border-0 mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col text-center p-3">
                            <h3 class="mb-1">{{ Auth::user()->events()->count() }}</h3>
                            <small class="text-muted">Eventos Totales</small>
                        </div>
                        <div class="col text-center p-3 border-start">
                            <h3 class="mb-1">{{ Auth::user()->events()->where('estado', 'programado')->count() }}</h3>
                            <small class="text-muted">Activos</small>
                        </div>
                        <div class="col text-center p-3 border-start">
                            <h3 class="mb-1">{{ Auth::user()->events()->where('estado', 'finalizado')->count() }}</h3>
                            <small class="text-muted">Finalizados</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Próximos Eventos -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Próximos Eventos</h5>
                </div>
                <div class="card-body">
                    @php
                        $proximosEventos = Auth::user()->events()
                            ->where('fecha', '>=', now())
                            ->where('estado', 'programado')
                            ->orderBy('fecha')
                            ->take(5)
                            ->get();
                    @endphp

                    @if($proximosEventos->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($proximosEventos as $evento)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $evento->nombre }}</h6>
                                            <p class="text-muted small mb-0">
                                                <i class="far fa-calendar-alt me-1"></i>{{ $evento->fecha->format('d/m/Y') }}
                                                <i class="far fa-clock ms-2 me-1"></i>{{ $evento->hora_inicio }}
                                                <i class="fas fa-map-marker-alt ms-2 me-1"></i>{{ $evento->ubicacion->nombre }}
                                            </p>
                                        </div>
                                        <a href="{{ route('events.show', $evento) }}" class="btn btn-sm btn-outline-primary">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No tienes eventos próximos</p>
                    @endif
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Actividad Reciente</h5>
                </div>
                <div class="card-body">
                    @php
                        $eventosRecientes = Auth::user()->events()
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp

                    @if($eventosRecientes->count() > 0)
                        <div class="timeline">
                            @foreach($eventosRecientes as $evento)
                                <div class="timeline-item pb-3">
                                    <div class="d-flex">
                                        <div class="timeline-marker"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">{{ $evento->nombre }}</h6>
                                            <p class="text-muted small mb-0">
                                                <span class="badge {{ $evento->estado === 'programado' ? 'bg-success' : 
                                                    ($evento->estado === 'cancelado' ? 'bg-danger' : 'bg-primary') }}">
                                                    {{ ucfirst($evento->estado) }}
                                                </span>
                                                <span class="ms-2">{{ $evento->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No hay actividad reciente</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 1rem;
}

.timeline-item {
    position: relative;
    padding-left: 1.5rem;
    border-left: 2px solid #e9ecef;
}

.timeline-marker {
    position: absolute;
    left: -0.35rem;
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    background: #90CAF9;
    border: 2px solid #fff;
}

.timeline-content {
    padding-bottom: 1rem;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@endsection