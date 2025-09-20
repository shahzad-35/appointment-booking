<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Service;

class ServiceManagement extends Component
{
    public $services;
    public function render()
    {
        $this->services = Service::with(['industry', 'owner'])->get();

        return view('livewire.admin.service-management');
    }
}

