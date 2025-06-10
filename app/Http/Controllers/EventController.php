<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->where('start_date', '>', now())
            ->with('creator')
            ->latest()
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'max_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $validated['available_tickets'] = $validated['max_tickets'];
        $validated['created_by'] = Auth::id();

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evenement succesvol aangemaakt!');
    }

    public function show(Event $event)
    {
        $event->load('creator', 'tickets');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'max_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        if ($validated['max_tickets'] != $event->max_tickets) {
            $ticketsSold = $event->tickets_sold;
            $validated['available_tickets'] = max(0, $validated['max_tickets'] - $ticketsSold);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evenement succesvol bijgewerkt!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evenement succesvol verwijderd!');
    }
}
