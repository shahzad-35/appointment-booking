<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-medium">Total Services</h3>
            <p class="mt-2 text-3xl font-bold">{{ $totalServices }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-medium">Total Slots</h3>
            <p class="mt-2 text-3xl font-bold">{{ $totalSlots }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-medium">Total Bookings</h3>
            <p class="mt-2 text-3xl font-bold">{{ $totalBookings }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-medium">Today’s Bookings</h3>
            <p class="mt-2 text-3xl font-bold">{{ $todayBookings }}</p>
        </div>
    </div>
    <form method="GET" action="{{ route('owner.bookings') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
            <select id="service_id" name="service_id" class="mt-1 block w-48 border-gray-300 rounded-md shadow-sm">
                <option value="">All Services</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="date" name="date"
                   value="{{ request('date') }}"
                   class="mt-1 block w-48 border-gray-300 rounded-md shadow-sm"/>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Filter
            </button>
            <a href="{{ route('owner.bookings') }}"
               class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Reset
            </a>
        </div>
    </form>
</div>
