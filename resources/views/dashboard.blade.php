<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welkom, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600">Ontdek geweldige evenementen en beheer je tickets.</p>
                </div>
            </div>

            <!-- My Tickets Section -->
            @if($userTickets->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Mijn Tickets</h3>
                        <a href="{{ route('tickets.index') }}" class="text-blue-600 hover:text-blue-800">Alle tickets bekijken</a>
                    </div>
                    <div class="space-y-3">
                        @foreach($userTickets as $ticket)
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $ticket->event->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $ticket->event->start_date->format('d M Y, H:i') }}</p>
                                    <p class="text-sm text-gray-500">Ticket: {{ $ticket->ticket_number }}</p>
                                </div>
                                <span class="badge 
                                    @if($ticket->status === 'active') badge-success
                                    @elseif($ticket->status === 'cancelled') badge-danger
                                    @else badge-secondary @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Upcoming Events Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Aankomende Evenementen</h3>
                        <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-800">Alle evenementen bekijken</a>
                    </div>
                    @if($upcomingEvents->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($upcomingEvents as $event)
                        <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                            @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-32 object-cover">
                            @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Geen afbeelding</span>
                            </div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-900 mb-1">{{ $event->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $event->start_date->format('d M Y, H:i') }}</p>
                                <p class="text-sm text-gray-500 mb-2">{{ $event->location }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-blue-600">€{{ number_format($event->price, 2) }}</span>
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">
                                        Bekijken
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500">Geen aankomende evenementen beschikbaar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
