@extends('layouts.app')

@section('title', 'Upcoming Events')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 bg-gradient-to-r from-blue-500 to-indigo-500 text-white">
                <h1 class="text-3xl font-bold mb-3">Welcome to Eventify</h1>
                <p class="mb-6">Discover and join amazing events or create your own!</p>
                
                @auth
                    <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150">
                        Create New Event
                    </a>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-transparent border border-white text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-white/10 focus:bg-white/10 active:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition ease-in-out duration-150">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4 text-gray-800 px-4 sm:px-0">Upcoming Events</h2>

        <!-- Events Grid -->
        @if ($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-0">
                @foreach ($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>
            
            <div class="mt-6 px-4 sm:px-0">
                {{ $events->links() }}
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>No upcoming events found. Be the first to create one!</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
