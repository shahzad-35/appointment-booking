<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        @foreach (['users'=>'Users','industries'=>'Industries','services'=>'Services','bookings'=>'Bookings'] as $key=>$label)
            <div class="bg-white p-4 shadow rounded-lg text-center">
                <p class="text-gray-500">{{ $label }}</p>
                <h2 class="text-2xl font-bold">{{ $stats[$key] }}</h2>
            </div>
        @endforeach
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
        <table class="w-full border-collapse border border-gray-200">
            <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Customer</th>
                <th class="border px-4 py-2">Service</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recentBookings as $booking)
                <tr>
                    <td class="border px-4 py-2">{{ $booking->user->name }}</td>
                    <td class="border px-4 py-2">{{ $booking->slot->service->name }}</td>
                    <td class="border px-4 py-2">{{ $booking->slot->date }} {{ $booking->slot->time }}</td>
                    <td class="border px-4 py-2">
                            <span class="
                                px-2 py-1 rounded text-black font-bold text-sm
                                {{ $booking->status === 'pending' ? 'bg-yellow-500' : '' }}
                                {{ $booking->status === 'confirmed' ? 'bg-green-500' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-red-500' : '' }}
                            ">
{{--                                @dump($booking)--}}
                                {{ ucfirst($booking->status) }}
                            </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
