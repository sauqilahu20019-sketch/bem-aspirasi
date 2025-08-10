<?php

namespace App\Livewire;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Rektor extends Component
{
    public $perPage = 10;
    public  $search = '';

    public $nim;
    public $full_name;
    public $password;
    public User $admin;

    public function store()
    {
       $validated = $this->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'unique:' . User::class],
            'password' => ['required', 'string']
        ], [
            'full_name.required' => 'Nama harus diisi!',
            'full_name.string' => 'Nama harus berupa Text!',
            'full_name.max' => 'Max. Nama 255 Karakter',
            'nim.required' => 'NIDN harus diisi!',
            'nim.string' => 'NIDN harus berupa Text!',
            'nim.unique' => 'NIDN sudah digunakan!',
            'password.required' => 'Password harus diisi!',
            'password.string' => 'Password harus berupa Text!',
        ]);

        $validated['role_id'] = 2;
        $validated['password'] = Hash::make($validated['password']);
        try{
            User::create($validated);
            Flux::modals()->close();
            $this->dispatch('alert',
                type: 'success',
                title: 'Sukses',
                text: 'Admin berhasil ditambahkan!'
            );
            $this->reset();
        }catch(\Exception $e){
            Flux::modals()->close();
            $this->dispatch('alert',
                type: 'error',
                title: 'Error',
                timer: 5000,
                text: $e->getMessage()
            );
        }
    }

    public function edit(User $id)
    {
        $this->admin = $id;
        $this->nim = $id->nim;
        $this->full_name = $id->full_name;
        Flux::modal('edit-admin')->show();
    }

    public function update()
    {
        $validated = $this->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', Rule::unique(User::class, 'nim')->ignore($this->admin->id_user, 'id_user')],
        ], [
            'full_name.required' => 'Nama harus diisi!',
            'full_name.string' => 'Nama harus berupa Text!',
            'full_name.max' => 'Max. Nama 255 Karakter',
            'nim.required' => 'NIDN harus diisi!',
            'nim.string' => 'NIDN harus berupa Text!',
            'nim.unique' => 'NIDN sudah digunakan!',
        ]);
        try{
            $this->admin->update($validated);
            Flux::modals()->close();
            $this->dispatch('alert',
                type: 'success',
                title: 'Sukses',
                text: 'Admin berhasil diupdate!'
            );
            $this->reset();
        }catch(\Exception $e){
            Flux::modals()->close();
            $this->dispatch('alert',
                type: 'error',
                title: 'Error',
                timer: 5000,
                text: $e->getMessage()
            );
        }
    }

    #[On('delete')]
    public function delete(User $id)
    {
        $id->delete();

        $this->dispatch(
            'alert',
            type: 'success',
            title: "Success",
            text: "Admin deleted successfully!"
        );
    }

    public function confirmDelete(User $id)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'question',
            title: 'Are you sure?',
            text: 'This action cannot be revert!',
            id: $id->id_user
        );
    }

    public function render()
    {
        if ($this->search) {
            $users = User::onlyRektor()->where('full_name', 'like', '%' . $this->search . '%')
                ->orWhere('nim', 'like', '%' . $this->search . '%')
                ->latest()->paginate($this->perPage);
        } else {
            $users = User::onlyRektor()->paginate($this->perPage);
        }
        return view('livewire.rektor', [
            'users' => $users,
        ]);
    }
}
