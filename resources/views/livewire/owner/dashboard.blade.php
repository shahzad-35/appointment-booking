<div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-sm font-medium text-gray-500">Total Services</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalServices }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-sm font-medium text-gray-500">Total Slots</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalSlots }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-sm font-medium text-gray-500">Total Bookings</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalBookings }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-sm font-medium text-gray-500">Today’s Bookings</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $todayBookings }}</p>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('owner.bookings') }}"
          class="bg-white p-6 rounded-lg shadow grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-end">

        <!-- Service Filter -->
        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
            <select id="service_id" name="service_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">All Services</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date Filter -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" id="date" name="date"
                   value="{{ request('date') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2 md:col-span-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Filter
            </button>
            <a href="{{ route('owner.bookings') }}"
               class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                Reset
            </a>
        </div>

    </form>

</div>
