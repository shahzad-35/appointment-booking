<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalBookings = 0;
    public $upcomingBookings = 0;
    public $cancelledBookings = 0;
    public $recentBookings = [];

    public function mount()
    {
        $userId = Auth::id();

        $this->totalBookings = Booking::where('user_id', $userId)->count();
        $this->upcomingBookings = Booking::where('user_id', $userId)
            ->where('status', '!=', 'cancelled')
            ->whereHas('slot', function ($query) {
                $query->whereDate('date', '>=', now());
            })
            ->count();
        $this->cancelledBookings = Booking::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->count();

        $this->recentBookings = Booking::with('slot.service')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.customer.dashboard');
    }
}
