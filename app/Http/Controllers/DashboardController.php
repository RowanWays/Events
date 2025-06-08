<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Alle gebruikers (inclusief admins) zien dezelfde dashboard
        $upcomingEvents = Event::where('is_active', true)
            ->where('start_date', '>', now())
            ->latest()
            ->take(6)
            ->get();
        
        $userTickets = $user->tickets()
            ->with('event')
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard', compact('upcomingEvents', 'userTickets'));
    }
}
