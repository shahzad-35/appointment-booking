<div class="p-6 space-y-6">

    <!-- Welcome Message -->
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600 mt-1">Here’s a quick summary of your bookings.</p>
    </div>

    <!-- Booking Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-500 text-white rounded shadow p-4">
            <p class="text-sm">Total Bookings</p>
            <h2 class="text-2xl font-bold">{{ $totalBookings }}</h2>
        </div>
        <div class="bg-green-500 text-white rounded shadow p-4">
            <p class="text-sm">Upcoming</p>
            <h2 class="text-2xl font-bold">{{ $upcomingBookings }}</h2>
        </div>
        <div class="bg-red-500 text-white rounded shadow p-4">
            <p class="text-sm">Cancelled</p>
            <h2 class="text-2xl font-bold">{{ $cancelledBookings }}</h2>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold mb-4">Recent Bookings</h2>
        @if($recentBookings->count())
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Service</th>
                        <th class="px-4 py-2 text-left">Date & Time</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($recentBookings as $booking)
                        <tr>
                            <td class="px-4 py-2">{{ $booking->slot->service->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($booking->slot_date)->format('M d, Y') }}
                                {{ \Carbon\Carbon::parse($booking->slot->start_time ?? '00:00')->format('h:i A') }}
                                - {{ \Carbon\Carbon::parse($booking->slot->end_time ?? '00:00')->format('h:i A') }}
                            </td>
                            <td class="px-4 py-2 capitalize">{{ $booking->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No bookings yet.</p>
        @endif
    </div>

</div>
