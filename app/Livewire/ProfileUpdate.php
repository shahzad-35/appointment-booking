<?php

namespace App\Livewire;

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\User;

class ProfileUpdate extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $photo; // temporary upload or stored path
    public $phone;

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->photo = $user->photo; // stored path initially
    }

    public function updatedPhoto()
    {
        // Live preview for temporary upload
        if ($this->photo instanceof TemporaryUploadedFile) {
            $this->photoPreview = $this->photo->temporaryUrl();
        } else {
            $this->photoPreview = $this->photo ? Storage::url($this->photo) : null;
        }
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:15'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($this->photo instanceof TemporaryUploadedFile) {
            // delete old photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // store new photo
            $storedPath = $this->photo->store('profile-photos', 'public');
            $validated['photo'] = $storedPath;
            $this->photo = $storedPath; // replace temporary upload with stored path
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(route('dashboard'));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function render(): mixed
    {
        $photoPreview = $this->photo instanceof TemporaryUploadedFile
            ? $this->photo->temporaryUrl()
            : ($this->photo ? Storage::url($this->photo) : null);

        return view('livewire.profile-update', compact('photoPreview'));
    }
}
