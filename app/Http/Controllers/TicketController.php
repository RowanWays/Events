<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()
            ->with('event')
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function purchase(Request $request, Event $event)
    {
        if (!$event->hasAvailableTickets()) {
            return back()->with('error', 'Dit evenement is uitverkocht!');
        }

        if ($event->start_date <= now()) {
            return back()->with('error', 'Je kunt geen tickets meer kopen voor dit evenement.');
        }

        $existingTicket = Auth::user()->tickets()
            ->where('event_id', $event->id)
            ->where('status', 'active')
            ->first();

        if ($existingTicket) {
            return back()->with('error', 'Je hebt al een ticket voor dit evenement!');
        }

        $ticket = Ticket::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'price_paid' => $event->price,
            'status' => 'active',
        ]);

        $event->decrementAvailableTickets();

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket succesvol gekocht!');
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Je hebt geen toegang tot dit ticket.');
        }

        $ticket->load('event', 'user');
        return view('tickets.show', compact('ticket'));
    }

    public function cancel(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Je kunt alleen je eigen tickets annuleren.');
        }

        if ($ticket->status !== 'active') {
            return back()->with('error', 'Dit ticket is al geannuleerd of gebruikt.');
        }

        if ($ticket->event->start_date <= now()->addHours(24)) {
            return back()->with('error', 'Je kunt dit ticket niet meer annuleren (minder dan 24 uur voor het evenement).');
        }

        $ticket->cancel();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket succesvol geannuleerd!');
    }
}
