<?php

namespace App\Livewire\Owner;

use Livewire\Component;
use App\Models\Service;
use App\Models\Industry;
use Illuminate\Support\Facades\Auth;

class Services extends Component
{
    public $name, $description, $price, $industry_id;
    public $services, $industries;
    public $editingId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'industry_id' => 'required|exists:industries,id',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->industries = Industry::all();
        $this->services = Service::getServicesByOwnerId(Auth::id());
    }

    public function save()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'industry_id' => $this->industry_id,
            'owner_id' => Auth::id(),
        ]);

        $this->reset(['name', 'description', 'price', 'industry_id']);
        $this->services = Service::getServicesByOwnerId(Auth::id());
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->editingId = $id;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->industry_id = $service->industry_id;
    }

    public function update()
    {
        $this->validate();
        $service = Service::findOrFail($this->editingId);
        $service->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'industry_id' => $this->industry_id,
        ]);

        $this->reset(['name', 'description', 'price', 'industry_id', 'editingId']);
        $this->services = Service::getServicesByOwnerId(Auth::id());
    }

    public function delete($id)
    {
        Service::destroy($id);
        $this->services = Service::getServicesByOwnerId(Auth::id());
    }

    public function render()
    {
        return view('livewire.owner.services');
    }
}
