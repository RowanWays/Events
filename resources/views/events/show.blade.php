<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
                @endif
                
                <div class="p-6">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-4">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold">Start:</div>
                                        <div>{{ $event->start_date->format('d M Y, H:i') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold">Eind:</div>
                                        <div>{{ $event->end_date->format('d M Y, H:i') }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold">Locatie:</div>
                                        <div>{{ $event->location }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600 mb-2">€{{ number_format($event->price, 2) }}</div>
                                    <div class="text-sm text-gray-600 mb-3">
                                        {{ $event->available_tickets }} van {{ $event->max_tickets }} tickets beschikbaar
                                    </div>
                                    
                                    @auth
                                        @php
                                            $userHasTicket = auth()->user()->tickets()
                                                ->where('event_id', $event->id)
                                                ->where('status', 'active')
                                                ->exists();
                                        @endphp
                                        
                                        @if($userHasTicket)
                                            <div class="bg-green-100 text-green-800 px-3 py-2 rounded text-sm">
                                                Je hebt al een ticket voor dit evenement
                                            </div>
                                        @elseif(!$event->hasAvailableTickets())
                                            <div class="bg-red-100 text-red-800 px-3 py-2 rounded text-sm">
                                                Uitverkocht
                                            </div>
                                        @elseif($event->start_date <= now())
                                            <div class="bg-gray-100 text-gray-800 px-3 py-2 rounded text-sm">
                                                Verkoop gesloten
                                            </div>
                                        @else
                                            <form method="POST" action="{{ route('tickets.purchase', $event) }}">
                                                @csrf
                                                <button type="submit" class="w-full btn btn-primary">
                                                    Koop Ticket
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full btn btn-secondary text-center">
                                            Log in om ticket te kopen
                                        </a>
                                    @endauth
                                </div>
                                
                                <div class="text-sm text-gray-600">
                                    <div class="font-semibold">Georganiseerd door:</div>
                                    <div>{{ $event->creator->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Beschrijving</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
