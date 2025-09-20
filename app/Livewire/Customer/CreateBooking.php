<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CreateBooking extends Component
{
    public $industries = [];
    public $services = [];
    public $slots = [];

    public $selectedIndustry = null;
    public $selectedService = null;
    public $selectedSlot = null;

    public function mount()
    {
        $this->industries = Industry::all();
    }

    public function updatedSelectedIndustry($industryId)
    {
        $this->services = $industryId ? Service::where('industry_id', $industryId)->get() : collect();
        $this->reset(['selectedService', 'selectedSlot', 'slots']);
    }

    public function updatedSelectedService($serviceId)
    {
        $this->slots = $serviceId ? Slot::where('service_id', $serviceId)
            ->whereDoesntHave('bookings')
            ->get() : collect();
        $this->reset('selectedSlot');
    }

    public function confirmBooking()
    {
        $exists = Booking::where('slot_id', $this->selectedSlot)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            session()->flash('error', 'This slot is no longer available. Please select another.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $this->selectedService,
            'slot_id' => $this->selectedSlot,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Booking created successfully.');
        return redirect()->route('customer.bookings');
    }


    public function render()
    {
        return view('livewire.customer.create-booking');
    }
}
