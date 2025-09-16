<?php

namespace App\Livewire\Admin;

use App\Models\Industry;
use Livewire\Component;

class Industries extends Component
{
    public $name;
    public $industries;
    public $editingId = null;

    protected $rules = [
        'name' => 'required|string|max:255|unique:industries,name',
    ];

    public function mount()
    {
        $this->industries = Industry::all();
    }

    public function save()
    {
        $this->validate();
        Industry::create(['name' => $this->name]);
        $this->reset('name');
        $this->industries = Industry::all();
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        $this->editingId = $id;
        $this->name = $industry->name;
    }

    public function update()
    {
        $this->validate();
        $industry = Industry::findOrFail($this->editingId);
        $industry->update(['name' => $this->name]);
        $this->reset(['name', 'editingId']);
        $this->industries = Industry::all();
    }

    public function delete($id)
    {
        Industry::destroy($id);
        $this->industries = Industry::all();
    }

    public function render()
    {
        return view('livewire.admin.industries');
    }
}
