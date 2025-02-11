<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'location_id',
        'category_id',
        'imagen',
        'capacidad',
        'estado'
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
        'capacidad' => 'integer'
    ];

    /**
     * Obtener la ubicación asociada al evento
     */
    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * Obtener la categoría del evento
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Scope para eventos próximos
     */
    public function scopeProximos($query)
    {
        return $query->where('fecha', '>=', now())
                    ->orderBy('fecha', 'asc')
                    ->orderBy('hora_inicio', 'asc');
    }

    /**
     * Scope para eventos por categoría
     */
    public function scopePorCategoria($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Verificar si el evento está lleno
     */
    public function estaLleno(): bool
    {
        return $this->registrados()->count() >= $this->capacidad;
    }

    /**
     * Obtener los usuarios registrados al evento
     */
    public function registrados()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withTimestamps()
                    ->withPivot('estado');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}