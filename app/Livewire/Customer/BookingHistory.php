<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingHistory extends Component
{
    public $bookings;

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::with('slot.service')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        $this->loadBookings();

        session()->flash('message', 'Booking cancelled successfully.');
    }

    public function render()
    {
        return view('livewire.customer.booking-history');
    }
}

