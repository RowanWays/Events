<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">{{ $ticket->event->title }}</h3>
                                <p class="text-lg text-gray-600">Ticket #{{ $ticket->ticket_number }}</p>
                            </div>
                            <div class="text-right">
                                <span class="badge
                                    {{ $ticket->status === 'active' ? 'badge-success' : 
                                       ($ticket->status === 'used' ? 'badge-info' : 'badge-danger') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Evenement Details</h4>
                            <div class="space-y-2">
                                <p><span class="font-medium">Locatie:</span> {{ $ticket->event->location }}</p>
                                <p><span class="font-medium">Start:</span> {{ $ticket->event->start_date->format('d-m-Y H:i') }}</p>
                                <p><span class="font-medium">Einde:</span> {{ $ticket->event->end_date->format('d-m-Y H:i') }}</p>
                                @if($ticket->event->description)
                                    <p><span class="font-medium">Beschrijving:</span></p>
                                    <p class="text-gray-600">{{ $ticket->event->description }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Ticket Informatie</h4>
                            <div class="space-y-2">
                                <p><span class="font-medium">Eigenaar:</span> {{ $ticket->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $ticket->user->email }}</p>
                                <p><span class="font-medium">Gekocht op:</span> {{ $ticket->created_at->format('d-m-Y H:i') }}</p>
                                <p><span class="font-medium">Prijs betaald:</span> €{{ number_format($ticket->price_paid, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($ticket->event->image_path)
                        <div class="mb-6">
                            <img src="{{ Storage::url($ticket->event->image_path) }}" 
                                 alt="{{ $ticket->event->title }}" 
                                 class="w-full h-64 object-cover rounded-lg">
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <a href="{{ route('tickets.index') }}" 
                           class="btn btn-secondary">
                            ← Terug naar Tickets
                        </a>
                        
                        @if($ticket->status === 'active' && $ticket->user_id === auth()->id())
                            @if($ticket->event->start_date > now()->addHours(24))
                                <form action="{{ route('tickets.cancel', $ticket) }}" method="POST" 
                                      onsubmit="return confirm('Weet je zeker dat je dit ticket wilt annuleren?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Ticket Annuleren
                                    </button>
                                </form>
                            @else
                                <p class="text-sm text-gray-500">
                                    Annulering niet meer mogelijk (minder dan 24 uur voor het evenement)
                                </p>
                            @endif
                        @endif
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-lg text-center">
                        <h4 class="text-lg font-semibold mb-2">QR Code</h4>
                        <div class="w-32 h-32 bg-gray-200 mx-auto rounded flex items-center justify-center">
                            <span class="text-gray-500">QR Code hier</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Laat deze QR code zien bij de ingang van het evenement
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
