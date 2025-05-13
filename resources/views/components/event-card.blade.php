@props(['event'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">
            <a href="{{ route('events.show', $event) }}" class="hover:text-event-primary transition">
                {{ $event->title }}
            </a>
        </h3>
        
        <div class="flex items-center text-gray-500 text-sm mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>{{ $event->location }}</span>
        </div>
        
        <div class="flex items-center text-gray-500 text-sm mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>{{ $event->start_time->format('M d, Y - H:i') }}</span>
        </div>
        
        <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
        
        <div class="flex justify-between items-center">
            <span class="text-sm text-gray-500">
                By {{ $event->creator->name }}
            </span>
            
            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-4 py-2 bg-event-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-event-secondary focus:bg-event-secondary active:bg-event-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                View Details
            </a>
        </div>
    </div>
</div>
