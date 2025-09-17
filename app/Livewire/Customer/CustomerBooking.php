<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CustomerBooking extends Component
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
        $this->validate([
            'selectedIndustry' => 'required|exists:industries,id',
            'selectedService' => 'required|exists:services,id',
            'selectedSlot' => 'required|exists:slots,id',
        ]);

        Booking::create([
            'customer_id' => Auth::id(),
            'service_id' => $this->selectedService,
            'slot_id' => $this->selectedSlot,
            'status' => 'confirmed',
        ]);

        session()->flash('message', 'Booking confirmed successfully!');
        $this->reset(['selectedIndustry', 'selectedService', 'selectedSlot', 'services', 'slots']);
    }

    public function render()
    {
        return view('livewire.customer.customer-booking');
    }
}
