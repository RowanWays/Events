<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Totaal Evenementen</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ $totalEvents }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Actieve Evenementen</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ $activeEvents }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Verkochte Tickets</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ $totalTicketsSold }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Totale Omzet</div>
                                <div class="text-2xl font-semibold text-gray-900">€{{ number_format($totalRevenue, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Snelle Acties</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary text-center">
                            Nieuw Evenement
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-success text-center">
                            Beheer Evenementen
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning text-center">
                            Beheer Gebruikers
                        </a>
                        <a href="{{ route('admin.tickets.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-center transition-colors">
                            Bekijk Tickets
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Events and Tickets -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Events -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recente Evenementen</h3>
                        @if($recentEvents->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentEvents as $event)
                            <div class="border-l-4 border-blue-500 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $event->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $event->start_date->format('d M Y, H:i') }}</p>
                                        <p class="text-sm text-gray-500">{{ $event->location }}</p>
                                    </div>
                                    <span class="badge {{ $event->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $event->is_active ? 'Actief' : 'Inactief' }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500">Geen evenementen gevonden.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Tickets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recente Tickets</h3>
                        @if($recentTickets->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentTickets as $ticket)
                            <div class="border-l-4 border-green-500 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $ticket->event->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $ticket->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $ticket->ticket_number }} - €{{ number_format($ticket->price_paid, 2) }}</p>
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
                        @else
                        <p class="text-gray-500">Geen tickets gevonden.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
