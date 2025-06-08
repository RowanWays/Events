<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredEvents = Event::where('start_date', '>=', now())
            ->where('is_active', true)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        return view('welcome', compact('featuredEvents'));
    }
}
