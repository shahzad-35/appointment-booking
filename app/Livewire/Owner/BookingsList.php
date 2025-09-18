<?php

namespace App\Livewire\Owner;

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
        $this->bookings = Booking::with(['slot.service', 'user'])
            ->whereHas('slot.service', function($query) {
                $query->where('owner_id', Auth::id());
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.owner.bookings-list');
    }
}
