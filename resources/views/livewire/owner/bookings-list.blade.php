<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Bookings</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div
            x-data="{ isShow: true }"
            x-init="setTimeout(() => isShow = false, 2000)"
            x-show="isShow"
            class="mb-4 text-green-600 font-medium transition duration-500"
        >
            {{ session('success') }}
        </div>
    @endif

    <!-- Bookings Table -->
    <table
        class="w-full table-auto border-collapse shadow rounded-lg overflow-hidden bg-white divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left">Customer Name</th>
            <th class="px-4 py-2 text-left">Service Name</th>
            <th class="px-4 py-2 text-left">Booking Time</th>
            <th class="px-4 py-2 text-left">Current Status</th>
            <th class="px-4 py-2 text-left">Reschedule</th>
            <th class="px-4 py-2 text-left">Update Status</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse($bookings as $booking)
            <tr class="hover:bg-gray-50 transition">
                <!-- Customer -->
                <td class="px-6 py-4 text-md text-gray-900">{{ $booking->user_name }}</td>

                <!-- Service -->
                <td class="px-6 py-4 text-md text-gray-700">{{ $booking->service_name }}</td>

                <!-- Booking Time -->
                <td class="px-6 py-4 text-md text-gray-600">
                    {{ \Carbon\Carbon::parse($booking->slot_date . ' ' . $booking->start_time)->format('M d, Y h:i A') }}
                    - {{ \Carbon\Carbon::parse($booking->slot_date . ' ' . $booking->end_time)->format('h:i A') }}
                </td>
                <td class="px-6 py-4 text-md text-gray-700">{{ ucfirst($booking->status) }}</td>
                <!-- Reschedule Button -->
                <td class="px-6 py-4">
                    <button wire:click="$set('rescheduleBookingId', {{ $booking->booking_id }})"
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Reschedule
                    </button>
                </td>

                <!-- Update Status Dropdown -->
                <td class="px-6 py-4">
                    <select
                        wire:change="updateBookingStatus({{ $booking->booking_id }}, $event.target.value)"
                        class="border rounded p-2 w-full"
                    >
                        @foreach(\App\Models\Booking::getBookingStatusesArray() as $key => $status)
                            @unless($key === \App\Models\Booking::BOOKING_STATUS_RESCHEDULED)
                                <option value="{{ $key }}" {{ $booking->status === $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endunless
                        @endforeach
                    </select>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    No bookings found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Reschedule Modal -->
    @if($rescheduleBookingId)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Reschedule Booking</h2>

                <select wire:model="newSlotId" class="w-full border p-2 rounded mb-4">
                    <option value="">Select a new slot</option>
                    @foreach($slots as $slot)
                        <option value="{{ $slot->id }}">
                            {{ $slot->service->name }}
                            — {{ \Carbon\Carbon::parse($slot->date . ' ' . $slot->start_time)->format('d M Y h:i A') }}
                        </option>
                    @endforeach
                </select>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('rescheduleBookingId', null)"
                            class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button wire:click="reschedule"
                            class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
