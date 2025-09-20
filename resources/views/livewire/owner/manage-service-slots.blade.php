<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Manage Slots for {{ $service->name }}</h2>

    <form wire:submit.prevent="save" class="mb-6 space-y-2">
        <input type="date" wire:model="date" class="border p-2 w-full">
        @error('date') <span class="text-red-600">{{ $message }}</span> @enderror

        <input type="time" wire:model="start_time" class="border p-2 w-full">
        @error('start_time') <span class="text-red-600">{{ $message }}</span> @enderror

        <input type="time" wire:model="end_time" class="border p-2 w-full">
        @error('end_time') <span class="text-red-600">{{ $message }}</span> @enderror

        <button type="submit" class="bg-green-500 text-white px-4 py-2">Add Slot</button>
    </form>

    <h3 class="font-bold mb-2">Available Slots</h3>
    <ul>
        @foreach($slots as $slot)
            <li class="flex items-center justify-between border-b py-2">
                <span>{{ \Carbon\Carbon::parse($slot->slot_date . ' ' . $slot->start_time)->format('M d, Y h:i A') }}
                    - {{ \Carbon\Carbon::parse($slot->slot_date . ' ' . $slot->end_time)->format('h:i A') }}</span>
                <button wire:click="delete({{ $slot->id }})" class="text-red-500">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
