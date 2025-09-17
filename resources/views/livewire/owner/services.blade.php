<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Manage Services</h2>

    <form wire:submit.prevent="{{ $editingId ? 'update' : 'save' }}" class="mb-6 space-y-2">
        <input type="text" wire:model="name" placeholder="Service Name" class="border p-2 w-full">
        @error('name') <span class="text-red-600">{{ $message }}</span> @enderror

        <textarea wire:model="description" placeholder="Description" class="border p-2 w-full"></textarea>
        @error('description') <span class="text-red-600">{{ $message }}</span> @enderror

        <input type="number" step="0.01" wire:model="price" placeholder="Price" class="border p-2 w-full">
        @error('price') <span class="text-red-600">{{ $message }}</span> @enderror

        <select wire:model="industry_id" class="border p-2 w-full">
            <option value="">-- Select Industry --</option>
            @foreach($industries as $industry)
                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
            @endforeach
        </select>
        @error('industry_id') <span class="text-red-600">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">
            {{ $editingId ? 'Update' : 'Add' }}
        </button>
    </form>

    <h3 class="font-bold mb-2">Your Services</h3>
    <ul>
        @foreach($services as $service)
            <li class="flex items-center justify-between border-b py-2">
                <span>{{ $service->name }} - {{ $service->price }} ({{ $service->industry->name }})</span>
                <div>
                    <button wire:click="edit({{ $service->id }})" class="text-yellow-500 mr-2">Edit</button>
                    <button wire:click="delete({{ $service->id }})" class="text-red-500">Delete</button>
                    <a href="{{ route('owner.slots', $service->id) }}" class="text-blue-600">Manage Slots</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
