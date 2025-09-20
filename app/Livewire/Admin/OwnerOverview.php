<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class OwnerOverview extends Component
{
    public $owners;

    public function render()
    {
        $this->owners = User::with('services.industry')->where('role', 'business_owner')->get();
        return view('livewire.admin.owner-overview');
    }
}
