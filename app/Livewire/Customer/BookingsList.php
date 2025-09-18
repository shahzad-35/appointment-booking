<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingsList extends Component
{
    public $bookings;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::with(['slot.service'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        $this->loadBookings();
    }

    public function reschedule($id, $newSlotId)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        $booking->update(['slot_id' => $newSlotId, 'status' => 'rescheduled']);
        $this->loadBookings();
    }

    public function render()
    {
        return view('livewire.customer.bookings-list');
    }
}
