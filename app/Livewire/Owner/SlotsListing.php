<?php

namespace App\Livewire\Owner;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Slot;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class SlotsListing extends Component
{
    public $slots;
    public $service_id, $start_time, $end_time, $editingId;
    public $services;

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

    public function save()
    {
        $this->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // prevent overlap
        $overlap = Slot::where('service_id', $this->service_id)
            ->where(function ($q) {
                $q->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('end_time', [$this->start_time, $this->end_time]);
            })
            ->exists();

        if ($overlap) {
            $this->addError('start_time', 'Slot overlaps with existing one.');
            return;
        }

        if ($this->editingId) {
            Slot::find($this->editingId)->update([
                'service_id' => $this->service_id,
                'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
                'end_time' => Carbon::parse($this->end_time)->format('H:i:s'),
            ]);
        } else {
            Slot::create([
                'owner_id' => Auth::id(),
                'service_id' => $this->service_id,
                'date' => Carbon::parse($this->start_time)->format('Y-m-d'),
                'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
                'end_time' => Carbon::parse($this->end_time)->format('H:i:s'),
            ]);
        }

        $this->reset(['service_id', 'start_time', 'end_time', 'editingId']);
        $this->loadSlots();
    }

    public function edit($id)
    {
        $slot = Slot::find($id);
        $this->editingId = $id;
        $this->service_id = $slot->service_id;
        $this->start_time = $slot->start_time;
        $this->end_time = $slot->end_time;
    }

    public function delete($id)
    {
        Slot::find($id)->delete();
        $this->loadSlots();
    }

    public function render()
    {
        $this->services = Service::where('owner_id', Auth::id())->get();
        return view('livewire.owner.slots-listing');
    }
}
