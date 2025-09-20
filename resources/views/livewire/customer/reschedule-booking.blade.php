<div class="max-w-lg mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-lg font-bold mb-4">Reschedule Booking</h2>

    <form wire:submit.prevent="reschedule">
        <div class="mb-4">
            <label class="block text-gray-700">Choose New Slot</label>
            <select wire:model="slot_id" class="w-full border rounded p-2">
                <option value="">Select Slot</option>
                @foreach($slots as $slot)
                    <option value="{{ $slot->id }}">
                        {{ $slot->start_time->format('M d, H:i') }} - {{ $slot->end_time->format('H:i') }}
                    </option>
                @endforeach
            </select>
            @error('slot_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Confirm Reschedule
        </button>
    </form>
</div>
