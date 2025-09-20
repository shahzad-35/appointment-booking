<div>
    <h1 class="text-2xl font-bold mb-6">All Services</h1>

    <table class="min-w-full bg-white border rounded-lg">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4">Service</th>
            <th class="py-2 px-4">Industry</th>
            <th class="py-2 px-4">Owner</th>
            <th class="py-2 px-4">Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $service->name }}</td>
                <td class="py-2 px-4">{{ $service->industry->name }}</td>
                <td class="py-2 px-4">{{ $service->owner->name }}</td>
                <td class="py-2 px-4">${{ $service->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>
