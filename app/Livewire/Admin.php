<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public $perPage = 10;
    public  $search = '';

    public $nim;
    public $full_name;

    public function store()
    {
       $validated = $this->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'unique:' . User::class]
        ], [
            'full_name.required' => 'Nama harus diisi!',
            'full_name.string' => 'Nama harus berupa Text!',
            'full_name.max' => 'Max. Nama 255 Karakter',
            'nim.required' => 'NIDN harus diisi!',
            'nim.string' => 'NIDN harus berupa Text!',
            'nim.unique' => 'NIDN sudah digunakan!',
        ]);

        try{
            User::create($validated);
        }catch(\Exception $e){
            $this->dispatch('alert',[
                type: 'error',
                title: 'Error',
                text: $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        if ($this->search) {
            $users = User::onlyAdmin()->where('full_name', 'like', '%' . $this->search . '%')
                ->orWhere('nim', 'like', '%' . $this->search . '%')
                ->latest()->paginate($this->perPage);
        } else {
            $users = User::onlyAdmin()->paginate($this->perPage);
        }
        return view('livewire.admin', [
            'users' => $users,
        ]);
    }
}
