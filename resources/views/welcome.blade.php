<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome to the Event Management Thing
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            Discover Amazing Events
                        </h1>
                        <p class="text-xl text-gray-600 mb-8">
                            Find and book tickets for the best events in your area
                        </p>
                        <div class="space-x-4">
                            <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Browse Events
                            </a>
                            @guest
                                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Sign Up
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

            @if($featuredEvents->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold mb-6">Featured Events</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($featuredEvents as $event)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h3 class="text-lg font-semibold mb-2">{{ $event->name }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $event->description }}</p>
                                    <p class="text-sm text-gray-500 mb-2">
                                        <strong>Date:</strong> {{ $event->date->format('M d, Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500 mb-2">
                                        <strong>Location:</strong> {{ $event->location }}
                                    </p>
                                    <p class="text-lg font-bold text-green-600 mb-3">
                                        ${{ number_format($event->price, 2) }}
                                    </p>
                                    <a href="{{ route('events.show', $event) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        View Details
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-6">
                            <a href="{{ route('events.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                View All Events →
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <h2 class="text-2xl font-bold mb-4">No Events Available</h2>
                        <p class="text-gray-600">Check back soon for exciting upcoming events!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>