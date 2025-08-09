<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $initial_name = '';

    public string $last_name = '';

    public string $nim = '';

    public string $prodi = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // dd("Hello");
        $validated = $this->validate([
            'initial_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'prodi' => ['required', 'string'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
                    ->min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
        ], [
            'initial_name.required' => 'Nama Depan harus diisi!',
            'initial_name.string' => 'Nama Depan harus berupa text!',
            'initial_name.max' => 'Max. Nama Depan 255 karakter',
            'last_name.string' => 'Nama belakang harus berupa text',
            'nim.required' => 'NIM harus diisi!',
            'nim.string' => 'NIM harus berupa text!',
            'nim.max' => 'Max. NIM 255 karakter!',
            'nim.unique' => 'NIM sudah digunakan!',
            'prodi.required' => 'Prodi harus diisi!',
            'prodi.string' => 'Harap memilih pilihan yang sudah disediakan!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!',
            'password.customMessages.min' => 'Password minimal 8 karakter!',
            'password.letters' => 'Password harus mengandung huruf!',
            'password.mixedCase' => 'Password harus mengandung huruf besar dan kecil!',
        ]);

        if ($this->last_name) {
            $validated['full_name'] = $validated['initial_name'] . " " . $validated['last_name'];
        } else {
            $validated['full_name'] = $validated['initial_name'];
        }
        $validated['role_id'] = 7;
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
