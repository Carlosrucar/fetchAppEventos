<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['categoria', 'ubicacion']);

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->location) {
            $query->where('location_id', $request->location);
        }

        if ($request->fecha) {
            $query->whereDate('fecha', $request->fecha);
        }

        $events = $query->latest()->paginate(3); // Cambiado a 3 elementos

        $categories = Category::all();
        $locations = Location::all();

        return view('events.index', compact('events', 'categories', 'locations'));
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('events.edit', compact('event', 'categories', 'locations'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha' => 'required|date',
                'hora_inicio' => 'required|date_format:H:i',
                'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
                'category_id' => 'required|exists:categories,id',
                'location_id' => 'required|exists:locations,id',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'capacidad' => 'nullable|integer|min:1'
            ]);

            if ($request->hasFile('imagen')) {
                $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
            }


            $validated['estado'] = 'programado';
            $event = Event::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Evento creado exitosamente',
                'event' => $event,
                'redirect' => route('events.show', $event)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el evento: ' . $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, Event $event)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha' => 'required|date',
                'hora_inicio' => 'required|date_format:H:i',
                'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
                'category_id' => 'required|exists:categories,id',
                'location_id' => 'required|exists:locations,id',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'capacidad' => 'nullable|integer|min:1',
                'estado' => 'required|in:programado,cancelado,finalizado'
            ]);

            if ($request->hasFile('imagen')) {
                if ($event->imagen) {
                    Storage::disk('public')->delete($event->imagen);
                }
                $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
            }
    
            $event->update($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Evento actualizado exitosamente',
                'event' => $event,
                'redirect' => route('events.show', $event)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el evento: ' . $e->getMessage()
            ], 422);
        }
    }

    public function destroy(Event $event)
{
    try {
        if ($event->imagen) {
            Storage::disk('public')->delete($event->imagen);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Evento eliminado exitosamente',
            'redirect' => route('events.index')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar el evento: ' . $e->getMessage()
        ], 422);
    }
    }   

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('events.create', compact('categories', 'locations'));
    }

    public function show(Event $event)
    {
        $relatedEvents = [];

        if ($event->user) {
            $relatedEvents = $event->user->events()
                ->where('id', '!=', $event->id)
                ->latest()
                ->take(5)
                ->get();
        }

        return view('events.show', [
            'event' => $event,
            'events' => $relatedEvents,
        ]);
    }
}