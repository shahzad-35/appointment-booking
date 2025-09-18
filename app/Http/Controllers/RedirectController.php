<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role == 'business_owner') {
            return redirect()->route('owner.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }
}

