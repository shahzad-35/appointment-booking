<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    public $roleUpdate = [];

    public function updateRole($userId, $role)
    {
        $user = User::findOrFail($userId);
        $user->update(['role' => $role]);
        session()->flash('success', 'User role updated!');
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('success', 'User deleted!');
    }

    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => User::paginate(10),
        ]);
    }
}
