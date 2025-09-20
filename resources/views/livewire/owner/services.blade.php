<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Services</h1>

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <input type="text" wire:model="name" placeholder="Service name" class="w-full border p-2 rounded">
        <input type="number" wire:model="price" placeholder="Price" class="w-full border p-2 rounded">
        <textarea wire:model="description" placeholder="Description" class="w-full border p-2 rounded"></textarea>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            {{ $editingId ? 'Update' : 'Add' }} Service
        </button>
    </form>

    <table class="w-full table-auto border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $service->name }}</td>
                <td class="px-4 py-2">{{ $service->price }}</td>
                <td class="px-4 py-2">{{ $service->description }}</td>
                <td class="px-4 py-2 space-x-2">
                    <button wire:click="edit({{ $service->id }})" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                    <button wire:click="delete({{ $service->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    <a href="{{ route('owner.service.slots', $service->id) }}" class="bg-green-600 text-white px-3 py-1 rounded">Manage Slots</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center py-4">No services found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
