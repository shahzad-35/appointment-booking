<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class BookingsList extends Component
{
    public $bookings;

    public function mount()
    {
        $this->bookings = Booking::with(['user', 'slot.service'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.bookings-list');
    }
}

