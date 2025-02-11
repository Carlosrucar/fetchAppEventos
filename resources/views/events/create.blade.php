@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <h3 class="mb-0">
                        <i class="fas fa-calendar-plus me-2"></i>
                        {{ __('Crear Nuevo Evento') }}
                    </h3>
                    <p class="mb-0 mt-2 text-white-50">Complete los detalles de su evento a continuación</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>¡Atención!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Información Básica -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-info-circle me-2"></i>Información Básica
                                </h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label">Nombre del Evento</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                          id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-clock me-2"></i>Fecha y Hora
                                </h5>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                                <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" 
                                       id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                                @error('hora_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="hora_fin" class="form-label">Hora de Finalización</label>
                                <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" 
                                       id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required>
                                @error('hora_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación y Categoría -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Ubicación y Categoría
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label">Ubicación</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" 
                                        id="location_id" name="location_id" required>
                                    <option value="">Seleccionar ubicación</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                            {{ $location->nombre }} - {{ $location->direccion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Categoría</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Detalles Adicionales -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-cog me-2"></i>Detalles Adicionales
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="imagen" class="form-label">Imagen del Evento</label>
                                <input type="file" class="form-control @error('imagen') is-invalid @enderror" 
                                       id="imagen" name="imagen" accept="image/*">
                                <div class="form-text">Formato: JPG, PNG. Tamaño máximo: 2MB</div>
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="capacidad" class="form-label">Capacidad</label>
                                <input type="number" class="form-control @error('capacidad') is-invalid @enderror" 
                                       id="capacidad" name="capacidad" value="{{ old('capacidad') }}" 
                                       placeholder="Dejar en blanco si no hay límite">
                                @error('capacidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Crear Evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script src="{{ asset('js/events.js') }}"></script>
<script>
    // Validación del formulario
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
@endsection