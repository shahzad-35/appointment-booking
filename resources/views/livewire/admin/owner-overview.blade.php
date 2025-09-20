<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Business Owners & Their Services</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Owner</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Industry</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Services</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Created</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @forelse($owners as $owner)
                        @php
                            $industries = $owner->services
                                ->pluck('industry.name')
                                ->filter()
                                ->unique();
                        @endphp
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                {{ $owner->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $owner->email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($owner->services->count())
                                    <ul class="list-disc list-inside">
                                        @foreach($industries as $industryName)
                                            <li>{{ $industryName }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 italic">No services</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($owner->services->count())
                                    <ul class="list-disc list-inside">
                                        @foreach($owner->services as $service)
                                            <li>{{ $service->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 italic">No services</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $owner->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No business owners found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
