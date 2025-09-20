<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class BookingManagement extends Component
{
    public $bookings;
    public $status;

    public function filterByStatus($status)
    {
        $this->status = $status;
    }
    public function render()
    {
        $query = Booking::with(['user', 'slot.service']);

        if ($this->status) {
            $query->where('status', $this->status);
        }
        $this->bookings = $query->get();
        return view('livewire.admin.booking-management');
    }
}
