<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

    @if(session('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">Service</th>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Time</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td class="border px-4 py-2">{{ $booking->slot->service->name }}</td>
                <td class="border px-4 py-2">{{ $booking->slot->date }}</td>
                <td class="border px-4 py-2">{{ $booking->slot->time }}</td>
                <td class="border px-4 py-2 capitalize">{{ $booking->status }}</td>
                <td class="border px-4 py-2">
                    @if($booking->status === 'pending')
                        <button wire:click="cancel({{ $booking->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Cancel
                        </button>
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4">No bookings found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
