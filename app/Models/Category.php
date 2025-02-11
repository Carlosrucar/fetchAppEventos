<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
        'color',
        'icono'
    ];

    /**
     * Obtener los eventos de esta categoría
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Scope para categorías activas
     */
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activa');
    }

    /**
     * Obtener el número de eventos activos en esta categoría
     */
    public function numeroEventosActivos(): int
    {
        return $this->eventos()
            ->where('fecha', '>=', now())
            ->count();
    }

    /**
     * Obtener las categorías más populares
     */
    public function scopePopulares($query, $limite = 5)
    {
        return $query->withCount(['eventos' => function($query) {
            $query->where('fecha', '>=', now());
        }])
        ->orderBy('eventos_count', 'desc')
        ->limit($limite);
    }
}