<?php

namespace App\Livewire\Owner;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class Services extends Component
{
    public $services;
    public $name, $price, $description, $editingId;

    public function mount()
    {
        $this->loadServices();
    }

    public function loadServices()
    {
        $this->services = Service::where('owner_id', Auth::id())->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        if ($this->editingId) {
            $service = Service::find($this->editingId);
            $service->update([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ]);
        } else {
            Service::create([
                'owner_id' => Auth::id(),
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'industry_id' => Auth::user()->industry_id, // assuming owner has one
            ]);
        }

        $this->reset(['name', 'price', 'description', 'editingId']);
        $this->loadServices();
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $this->editingId = $id;
        $this->name = $service->name;
        $this->price = $service->price;
        $this->description = $service->description;
    }

    public function delete($id)
    {
        Service::find($id)->delete();
        $this->loadServices();
    }

    public function render()
    {
        return view('livewire.owner.services');
    }
}
