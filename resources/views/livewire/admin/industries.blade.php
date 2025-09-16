<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Manage Industries</h2>

    <form wire:submit.prevent="{{ $editingId ? 'update' : 'save' }}" class="mb-6">
        <input type="text" wire:model="name" placeholder="Industry Name" class="border p-2">
        @error('name') <span class="text-red-600">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 ml-2">
            {{ $editingId ? 'Update' : 'Add' }}
        </button>
    </form>

    <ul>
        @foreach($industries as $industry)
            <li class="flex items-center justify-between border-b py-2">
                <span>{{ $industry->name }}</span>
                <div>
                    <button wire:click="edit({{ $industry->id }})" class="text-yellow-500 mr-2">Edit</button>
                    <button wire:click="delete({{ $industry->id }})" class="text-red-500">Delete</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
