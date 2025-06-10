<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();
        $totalTicketsSold = Ticket::where('status', 'active')->count();
        $totalRevenue = Ticket::where('status', 'active')->sum('price_paid');
        $recentEvents = Event::latest()->take(5)->get();
        $recentTickets = Ticket::with(['event', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'activeEvents', 
            'totalTicketsSold',
            'totalRevenue',
            'recentEvents',
            'recentTickets'
        ));
    }

    public function events()
    {
        $events = Event::with(['creator', 'tickets'])
            ->withCount('tickets')
            ->latest()
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function users()
    {
        $users = User::withCount('tickets')
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function tickets(Request $request)
    {
        $query = Ticket::with(['event', 'user']);

        if ($request->filled('event')) {
            $query->where('event_id', $request->event);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->user . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->user . '%');
            });
        }

        $tickets = $query->latest()->paginate(15);

        $totalTickets = Ticket::count();
        $activeTickets = Ticket::where('status', 'active')->count();
        $cancelledTickets = Ticket::where('status', 'cancelled')->count();
        $totalRevenue = Ticket::where('status', 'active')->sum('price_paid');

        $events = Event::orderBy('title')->get();

        return view('admin.tickets.index', compact(
            'tickets',
            'totalTickets',
            'activeTickets',
            'cancelledTickets',
            'totalRevenue',
            'events'
        ));
    }

    public function toggleUserAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);

        $status = $user->is_admin ? 'granted admin access' : 'admin access removed';
        
        return back()->with('success', "User {$user->name} has been {$status}.");
    }
}
