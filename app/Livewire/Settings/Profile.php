<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $full_name = '';

    public string $nim = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->full_name = Auth::user()->full_name;
        $this->nim = Auth::user()->nim;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'full_name' => ['required', 'string', 'max:255'],

            'nim' => [
                'required',
                'string',
                'lowercase',
                'max:255',
                'nim',
                Rule::unique(User::class)->ignore($user->id_user),
            ],
        ]);

        $user->fill($validated);

        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        $user->save();

        $this->dispatch('profile-updated', full_name: $user->full_name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}
