<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                        wire:navigate>
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')"
                                        wire:navigate>
                                Manage Users
                            </x-nav-link>
                            <x-nav-link :href="route('admin.services')" :active="request()->routeIs('admin.services')"
                                        wire:navigate>
                                Manage Services
                            </x-nav-link>
                            <x-nav-link :href="route('admin.bookings')" :active="request()->routeIs('admin.bookings')"
                                        wire:navigate>
                                Manage Bookings
                            </x-nav-link>
                            <x-nav-link :href="route('admin.owners')" :active="request()->routeIs('admin.owners')"
                                        wire:navigate>
                                Owners Info
                            </x-nav-link>
                        @elseif(auth()->user()->role == 'business_owner')
                            <x-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.dashboard')"
                                        wire:navigate>
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('owner.services')" :active="request()->routeIs('owner.services')"
                                        wire:navigate>
                                Services
                            </x-nav-link>
                            <x-nav-link :href="route('owner.slots')" :active="request()->routeIs('owner.slots')"
                                        wire:navigate>
                                Slots
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')"
                                        wire:navigate>
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('customer.create.booking')" :active="request()->routeIs('customer.create.booking')"
                                        wire:navigate>
                                Create Booking
                            </x-nav-link>
                            <x-nav-link :href="route('customer.bookings')" :active="request()->routeIs('customer.bookings')"
                                        wire:navigate>
                                Bookings
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side / Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ route('login') }}" class="text-blue-600 px-3">Login</a>
                    <a href="{{ route('register') }}" class="text-green-600 px-3">Register</a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                     x-text="name"
                                     x-on:profile-updated.window="name = $event.detail.name"></div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')"
                                           wire:navigate>
                        Admin Dashboard
                    </x-responsive-nav-link>
                @elseif(auth()->user()->role == 'business_owner')
                    <x-responsive-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.*')"
                                           wire:navigate>
                        Owner Dashboard
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('customer.dashboard')"
                                           :active="request()->routeIs('customer.*')" wire:navigate>
                        Customer Dashboard
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                    Login
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                    Register
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800"
                         x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                         x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>
