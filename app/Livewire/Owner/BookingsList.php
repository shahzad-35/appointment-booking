<?php

namespace App\Livewire\Owner;

use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BookingsList extends Component
{
    public $slots;
    public $bookings;
    public $rescheduleBookingId;
    public $newSlotId;

    public function mount()
    {
        $this->loadSlots();
    }

    public function loadSlots()
    {
        $this->slots = Slot::with('service')
            ->whereHas('service', fn($q) => $q->where('owner_id', Auth::id()))
            ->get();
    }

    public function cancel($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->slot->service->owner_id !== Auth::id()) {
            return;
        }

        $booking->update(['status' => 'cancelled']);

        session()->flash('success', 'Booking cancelled.');
    }

    public function reschedule()
    {
        $booking = Booking::findOrFail($this->rescheduleBookingId);
        $slot = Slot::findOrFail($this->newSlotId);

        if ($slot->service->owner_id !== Auth::id()) {
            return;
        }

        $booking->update(['slot_id' => $slot->id]);

        $this->reset(['rescheduleBookingId', 'newSlotId']);

        session()->flash('success', 'Booking rescheduled.');
    }

    public function render()
    {
        $ownerId = Auth::id();
        $serviceId = request('service_id');
        $date = request('date');

        $this->bookings = DB::table('bookings')
            ->join('slots', 'bookings.slot_id', '=', 'slots.id')
            ->join('services', 'slots.service_id', '=', 'services.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'bookings.id as booking_id',
                'users.name as user_name',
                'services.name as service_name',
                'slots.date as slot_date',
                'slots.start_time',
                'slots.end_time',
                'bookings.status',
                'bookings.updated_at as booking_updated_at'
            )
            ->where('services.owner_id', $ownerId)
            ->when($serviceId, fn($q) => $q->where('services.id', $serviceId))
            ->when($date, fn($q) => $q->whereDate('slots.date', $date))
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('livewire.owner.bookings-list');
    }
}
