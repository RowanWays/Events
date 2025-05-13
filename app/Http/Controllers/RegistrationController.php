<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    /**
     * Store a newly created registration in storage.
     */
    public function register(Event $event): RedirectResponse
    {
        // Check if user is already registered
        $alreadyRegistered = $event->attendees()->where('user_id', Auth::id())->exists();

        if ($alreadyRegistered) {
            return redirect()->back()->with('error', 'You are already registered for this event!');
        }

        // Create new registration
        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->event_id = $event->id;
        $registration->registered_at = now();
        $registration->save();

        return redirect()->back()->with('success', 'You have successfully registered for this event!');
    }

    /**
     * Remove the specified registration from storage.
     */
    public function cancel(Event $event): RedirectResponse
    {
        $registration = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if (!$registration) {
            return redirect()->back()->with('error', 'You are not registered for this event!');
        }

        $registration->delete();

        return redirect()->back()->with('success', 'Your registration has been canceled!');
    }

    /**
     * Display a listing of the user's registrations.
     */
    public function myRegistrations()
    {
        $registrations = Auth::user()->registrations()
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('registrations.my-registrations', compact('registrations'));
    }
}
