@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $event->title }}</h1>
                    
                    @auth
                        @if (Auth::id() === $event->created_by || Auth::user()->isAdmin())
                            <div class="flex space-x-2">
                                <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit Event
                                </a>
                                
                                <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="flex flex-col md:flex-row md:gap-8">
                    <div class="md:w-2/3">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2">Event Details</h2>
                            <p class="text-gray-700 whitespace-pre-line">{{ $event->description }}</p>
                        </div>
                        
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2">Organized by</h2>
                            <p class="text-gray-700">{{ $event->creator->name }}</p>
                        </div>
                    </div>
                    
                    <div class="md:w-1/3 bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Event Information</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="font-medium">Date & Time</p>
                                    <p class="text-gray-600">{{ $event->start_time->format('F j, Y - g:i A') }}</p>
                                    <p class="text-gray-600">To: {{ $event->end_time->format('F j, Y - g:i A') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="font-medium">Location</p>
                                    <p class="text-gray-600">{{ $event->location }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <div>
                                    <p class="font-medium">Attendees</p>
                                    <p class="text-gray-600">{{ $event->registrations->count() }} registered</p>
                                </div>
                            </div>
                            
                            @auth
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    @if ($userRegistered)
                                        <form method="POST" action="{{ route('registrations.cancel', $event) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                                Cancel Registration
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('registrations.register', $event) }}">
                                            @csrf
                                            <button type="submit" class="w-full bg-event-primary text-white py-2 px-4 rounded-md hover:bg-event-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                                Register for Event
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <a href="{{ route('login') }}" class="block text-center w-full bg-event-primary text-white py-2 px-4 rounded-md hover:bg-event-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                        Login to Register
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
