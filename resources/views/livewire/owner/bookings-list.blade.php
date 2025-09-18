<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Bookings for My Services</h2>

    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="w-full border">
            <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Service</th>
                <th class="p-2 border">Slot</th>
                <th class="p-2 border">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td class="p-2 border">{{ $booking->user->name }}</td>
                    <td class="p-2 border">{{ $booking->slot->service->name }}</td>
                    <td class="p-2 border">
                        {{ $booking->slot->start_time }} - {{ $booking->slot->end_time }}
                    </td>
                    <td class="p-2 border capitalize">{{ $booking->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
