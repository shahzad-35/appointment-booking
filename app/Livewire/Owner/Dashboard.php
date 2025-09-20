<?php

namespace App\Livewire\Owner;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Dashboard extends Component
{
    public $services;
    public $bookings;
    public $totalServices;
    public $totalBookings;
    public $totalSlots;
    public $todayBookings;

    public function render(Request $request)
    {

        $ownerId = auth()->id();

        $this->services = Service::where('owner_id', $ownerId)->get();

        $this->bookings = Booking::with(['slot.service', 'user'])
            ->whereHas('slot.service', fn($q) => $q->where('user_id', $ownerId))
            ->when($request->service_id, fn($q) => $q->where('service_id', $request->service_id))
            ->when($request->date, fn($q) => $q->whereDate('date', $request->date))
            ->latest()->get();

        $this->totalServices = Booking::query()
            ->join('slots', 'bookings.slot_id', '=', 'slots.id')
            ->join('services', 'slots.service_id', '=', 'services.id')
            ->where('services.owner_id', $ownerId)
            ->distinct('services.id')
            ->count('services.id');
        $this->totalSlots = Slot::whereHas('service', fn($q) => $q->where('owner_id', $ownerId)
        )->count();
        $this->totalBookings = Booking::whereHas('slot.service', fn($q) => $q->where('owner_id', $ownerId))->count();
        $this->todayBookings = Booking::whereHas('slot.service', fn($q) => $q->where('owner_id', $ownerId))
            ->whereDate('created_at', Carbon::today())
            ->count();

        return view('livewire.owner.dashboard');
    }
}
