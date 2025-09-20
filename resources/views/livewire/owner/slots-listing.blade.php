<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Slots</h1>

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <select wire:model="service_id" class="w-full border p-2 rounded">
            <option value="">Select Service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>

        <input type="datetime-local" wire:model="start_time" class="w-full border p-2 rounded">
        <input type="datetime-local" wire:model="end_time" class="w-full border p-2 rounded">

        @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            {{ $editingId ? 'Update' : 'Add' }} Slot
        </button>
    </form>

    <table class="w-full table-auto border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2">Service</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Start</th>
            <th class="px-4 py-2">End</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($slots as $slot)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $slot->service->name }}</td>
                <td class="px-4 py-2">{{ $slot->date }}</td>
                <td class="px-4 py-2">{{ $slot->start_time }}</td>
                <td class="px-4 py-2">{{ $slot->end_time }}</td>
                <td class="px-4 py-2 space-x-2">
                    <button wire:click="edit({{ $slot->id }})" class="bg-blue-500 text-white px-3 py-1 rounded">Edit
                    </button>
                    <button wire:click="delete({{ $slot->id }})" class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">No slots found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
