<?php

namespace App\Livewire\Customer;

use App\Models\Booking;
use App\Models\Slot;
use Livewire\Component;

class RescheduleBooking extends Component
{
    public $booking;
    public $slots;
    public $slot_id;

    public function mount(Booking $booking)
    {
        $this->booking = $booking;

        // fetch available slots for the same service, excluding already booked ones
        $this->slots = Slot::where('service_id', $booking->service_id)
            ->whereDoesntHave('bookings', fn($q) => $q->where('status', 'confirmed'))
            ->get();
    }

    public function reschedule()
    {
        $this->validate([
            'slot_id' => 'required|exists:slots,id',
        ]);

        $this->booking->update([
            'slot_id' => $this->slot_id,
            'status' => 'rescheduled',
        ]);

        session()->flash('success', 'Booking rescheduled successfully!');
        return redirect()->route('customer.bookings');
    }

    public function render()
    {
        return view('livewire.customer.reschedule-booking');
    }
}
