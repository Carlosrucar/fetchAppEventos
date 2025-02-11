<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'latitud',
        'longitud',
        'capacidad',
        'descripcion'
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitud' => 'float',
        'longitud' => 'float',
        'capacidad' => 'integer'
    ];

    /**
     * Obtener los eventos asociados con esta ubicación
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Scope para encontrar ubicaciones cercanas
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $latitud
     * @param float $longitud
     * @param int $radioKm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCercanas($query, $latitud, $longitud, $radioKm = 10)
    {
        $formula = "(6371 * acos(cos(radians($latitud)) 
                   * cos(radians(latitud)) 
                   * cos(radians(longitud) - radians($longitud)) 
                   + sin(radians($latitud)) 
                   * sin(radians(latitud))))";
        
        return $query->selectRaw("*, {$formula} AS distancia")
                    ->whereRaw("{$formula} < ?", [$radioKm])
                    ->orderBy('distancia');
    }

    /**
     * Verificar si la ubicación está disponible para una fecha específica
     */
    public function estaDisponible($fecha, $horaInicio, $horaFin): bool
    {
        return !$this->eventos()
            ->where('fecha', $fecha)
            ->where(function($query) use ($horaInicio, $horaFin) {
                $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                    ->orWhereBetween('hora_fin', [$horaInicio, $horaFin]);
            })->exists();
    }
}