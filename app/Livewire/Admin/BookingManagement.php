<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;

class BookingManagement extends Component
{
    public $filterStatus = '';

    public function render()
    {
        $query = Booking::with(['user', 'slot.service']);

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.admin.booking-management', [
            'bookings' => $query->paginate(10),
        ]);
    }
}
