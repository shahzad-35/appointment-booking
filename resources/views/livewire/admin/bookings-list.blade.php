<div class="p-6">
    <h2 class="text-xl font-bold mb-4">All Bookings</h2>

    <table class="w-full border">
        <thead>
        <tr class="bg-slate-700 text-white">
            <th class="p-2 border ">Customer</th>
            <th class="p-2 border">Service</th>
            <th class="p-2 border">Slot</th>
            <th class="p-2 border">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
{{--                @dd($booking->slot->service)--}}
                <td class="p-2 border">{{ $booking->user->name }}</td>
                <td class="p-2 border">{{ $booking->slot->service->name }}</td>
                <td class="p-2 border">{{ $booking->slot->start_time }} - {{ $booking->slot->end_time }}</td>
                <td class="p-2 border capitalize">{{ $booking->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
