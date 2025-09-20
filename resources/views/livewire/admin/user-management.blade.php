<div>
    <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

    @if(session()->has('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white border rounded-lg">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4 text-left">Name</th>
            <th class="py-2 px-4 text-left">Email</th>
            <th class="py-2 px-4 text-left">Role</th>
            <th class="py-2 px-4">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $user->name }}</td>
                <td class="py-2 px-4">{{ $user->email }}</td>
                <td class="py-2 px-4">
                    @unless($user->role === 'admin')
                        <select wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                class="border rounded p-1 w-6/12">
                            <option value="business_owner" {{ $user->role === 'business_owner' ? 'selected' : '' }}>
                                Owner
                            </option>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer
                            </option>
                        </select>
                    @endunless
                </td>
                <td class="py-2 px-4 text-center">
                    <button wire:click="deleteUser({{ $user->id }})"
                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
