@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 px-4 sm:px-0">Admin Dashboard</h1>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 px-4 sm:px-0">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Total Events</h2>
                <p class="text-3xl font-bold text-event-primary">{{ $totalEvents }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Total Users</h2>
                <p class="text-3xl font-bold text-event-primary">{{ $totalUsers }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Total Registrations</h2>
                <p class="text-3xl font-bold text-event-primary">{{ $totalRegistrations }}</p>
            </div>
        </div>
        
        <!-- Recent Events -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Recent Events</h2>
                    <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-event-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-event-secondary focus:bg-event-secondary active:bg-event-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Create New Event
                    </a>
                </div>
                
                @if ($recentEvents->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendees</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentEvents as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $event->creator->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $event->start_time->format('M d, Y - H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $event->registrations->count() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                            <a href="{{ route('events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">There are no events yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
