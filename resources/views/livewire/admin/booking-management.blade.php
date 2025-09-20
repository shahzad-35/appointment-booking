<div>
    <h1 class="text-2xl font-bold mb-6">All Bookings</h1>

    <div class="mb-4">
        <label class="mr-2">Filter by Status:</label>
        <select wire:change="filterByStatus($event.target.value)" class="border rounded p-1">
            <option value="">Select</option>
            @foreach(\App\Models\Booking::getBookingStatusesArray() as $key => $status)
                <option value="{{ $key }}">{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <table class="min-w-full bg-white border rounded-lg">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4">Customer</th>
            <th class="py-2 px-4">Service</th>
            <th class="py-2 px-4">Slot</th>
            <th class="py-2 px-4">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($bookings as $booking)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $booking->user->name }}</td>
                <td class="py-2 px-4">{{ $booking->slot->service->name }}</td>
                <td class="py-2 px-4">{{ $booking->slot->date }} {{ $booking->slot->time }}</td>
                <td class="py-2 px-4">{{ ucfirst($booking->status) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">No Bookings found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
