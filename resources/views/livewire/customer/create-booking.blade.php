<div>
    {{-- Select Industry --}}
    <div class="mb-4">
        <label class="block mb-2">Select Industry</label>
        <select wire:model.lazy="selectedIndustry" class="border p-2 w-full">
            <option value="">-- Choose Industry --</option>
            @foreach($industries as $industry)
                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Select Service --}}
    @if(!empty($services) && $services->count() > 0)
        <div class="mb-4">
            <label class="block mb-2">Select Service</label>
            <select wire:model.lazy="selectedService" class="border p-2 w-full">
                <option value="">-- Choose Service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- Select Slot --}}
    @if(!empty($slots) && $slots->count() > 0)
        <div class="mb-4">
            <label class="block mb-2">Select Time Slot</label>
            <select wire:model="selectedSlot" class="border p-2 w-full">
                <option value="">-- Choose Slot --</option>
                @foreach($slots as $slot)
                    <option value="{{ $slot->id }}">
                        {{ $slot->start_time }} - {{ $slot->end_time }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <button wire:click="confirmBooking" class="bg-blue-500 text-white p-2 rounded">
        Confirm Booking
    </button>
</div>
