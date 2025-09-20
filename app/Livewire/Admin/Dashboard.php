<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Booking;

class Dashboard extends Component
{
    public $stats;
    public $recentBookings;

    public function mount()
    {
        $this->stats = [
            'users' => User::count(),
            'admins' => User::getUsersByRole('admin')->count(),
            'owners' => User::getUsersByRole('business_owner')->count(),
            'customers' => User::getUsersByRole('customer')->count(),
            'industries' => Industry::count(),
            'services' => Service::count(),
            'bookings' => Booking::count(),
        ];

        $this->recentBookings = Booking::with('user', 'slot.service')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
