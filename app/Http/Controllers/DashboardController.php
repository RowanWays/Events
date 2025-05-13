<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin dashboard
            $totalEvents = Event::count();
            $totalUsers = User::count();
            $totalRegistrations = Registration::count();
            $recentEvents = Event::orderBy('created_at', 'desc')->limit(5)->get();
            
            return view('dashboard.admin', compact(
                'totalEvents',
                'totalUsers',
                'totalRegistrations',
                'recentEvents'
            ));
        } else {
            // User dashboard
            $upcomingEvents = $user->registeredEvents()
                ->where('start_time', '>=', now())
                ->orderBy('start_time')
                ->get();
                
            $createdEvents = $user->events()->orderBy('created_at', 'desc')->get();
            
            return view('dashboard.user', compact('upcomingEvents', 'createdEvents'));
        }
    }
}
