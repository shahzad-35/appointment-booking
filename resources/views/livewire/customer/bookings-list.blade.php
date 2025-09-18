<div class="p-6">
    <h2 class="text-xl font-bold mb-4">My Bookings</h2>

    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="w-full border">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Service</th>
                <th class="p-2 border">Slot</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td class="p-2 border">{{ $booking->slot->service->name }}</td>
                    <td class="p-2 border">
                        {{ $booking->slot->start_time }} - {{ $booking->slot->end_time }}
                    </td>
                    <td class="p-2 border capitalize">{{ $booking->status }}</td>
                    <td class="p-2 border">
                        @if($booking->status === 'confirmed')
                            <button wire:click="cancel({{ $booking->id }})"
                                    class="bg-red-500 text-white px-2 py-1">Cancel
                            </button>
                        @endif
                        {{-- Reschedule demo (pick first free slot) --}}
                        @if($booking->status === 'confirmed')
                            <button wire:click="reschedule({{ $booking->id }}, 1)"
                                    class="bg-yellow-500 text-white px-2 py-1">Reschedule
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
