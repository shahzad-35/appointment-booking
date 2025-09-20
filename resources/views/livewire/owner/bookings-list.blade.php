<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Bookings</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left">Customer</th>
            <th class="px-4 py-2 text-left">Service</th>
            <th class="px-4 py-2 text-left">Time</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse($bookings as $booking)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->user_name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->service_name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($booking->slot_date . ' ' . $booking->start_time)->format('M d, Y h:i A') }}
                    - {{ \Carbon\Carbon::parse($booking->slot_date . ' ' . $booking->end_time)->format('h:i A') }}
                </td>
                <td class="px-4 py-2 space-x-2">
                    <button wire:click="cancel({{ $booking->booking_id }})"
                            class="px-3 py-1 bg-red-500 text-white rounded">Cancel
                    </button>

                    <button wire:click="$set('rescheduleBookingId', {{ $booking->booking_id }})"
                            class="px-3 py-1 bg-blue-500 text-white rounded">Reschedule
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                    No bookings yet.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Reschedule Modal -->
    @if($rescheduleBookingId)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Reschedule Booking</h2>

                <select wire:model="newSlotId" class="w-full border p-2 rounded mb-4">
                    <option value="">Select a new slot</option>
                    @foreach($slots as $slot)
                        <option value="{{ $slot->id }}">
                            {{ $slot->service->name }} — {{ Carbon\Carbon::parse($slot->date . ' ' . $slot->start_time)->format('d M Y H:i') }}
                        </option>
                    @endforeach
                </select>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('rescheduleBookingId', null)"
                            class="px-3 py-1 bg-gray-300 rounded">Cancel
                    </button>
                    <button wire:click="reschedule"
                            class="px-3 py-1 bg-green-500 text-white rounded">Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
