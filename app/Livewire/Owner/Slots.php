<?php

namespace App\Livewire\Owner;

use Livewire\Component;
use App\Models\Service;
use App\Models\Slot;

class Slots extends Component
{
    public $service;
    public $date, $start_time, $end_time;
    public $slots;

    protected $rules = [
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ];

    public function mount($serviceId)
    {
        $this->service = Service::findOrFail($serviceId);
        $this->slots = $this->service->slots;
    }

    public function save()
    {
        $this->validate();

        Slot::create([
            'service_id' => $this->service->id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $this->reset(['date', 'start_time', 'end_time']);
        $this->slots = $this->service->slots;
    }

    public function delete($id)
    {
        Slot::destroy($id);
        $this->slots = $this->service->slots;
    }

    public function render()
    {
        return view('livewire.owner.slots');
    }
}
