<div>
    <h1 class="text-2xl font-bold mb-6">All Bookings</h1>

    <div class="mb-4">
        <label class="mr-2">Filter by Status:</label>
        <select wire:model="filterStatus" class="border rounded p-1">
            <option value="">All</option>
            <option value="confirmed">Confirmed</option>
            <option value="canceled">Canceled</option>
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
        @foreach($bookings as $booking)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $booking->user->name }}</td>
                <td class="py-2 px-4">{{ $booking->slot->service->name }}</td>
                <td class="py-2 px-4">{{ $booking->slot->date }} {{ $booking->slot->time }}</td>
                <td class="py-2 px-4">{{ ucfirst($booking->status) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $bookings->links() }}</div>
</div>
