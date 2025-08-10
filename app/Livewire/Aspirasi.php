<?php

namespace App\Livewire;

use App\Models\Aspirasi as ModelsAspirasi;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Aspirasi extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $ditujukan_ke;
    public $aspirasi;
    public ModelsAspirasi $model_aspirasi;
    public $data_warek;

    public function render()
    {
        $this->data_warek = User::onlyWarek()->get();

        $aspirasis = ModelsAspirasi::with(['pengaju', 'yangDituju.role'])
            ->when($this->search, function ($query) {
                $query->whereHas('pengaju', function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('nim', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.aspirasi', [
            'data' => $aspirasis,
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'ditujukan_ke' => ['required'],
            'aspirasi' => ['required', 'string', 'max:3000'],
        ], [
            'ditujukan_ke.required' => 'Tujuan aspirasi harus dipilih!',
            'aspirasi.required' => 'Aspirasi harus diisi!',
            'aspirasi.max' => 'Aspirasi maksimal 3000 karakter',
            'aspirasi.string' => 'Aspirasi harus berupa teks!',
        ]);

        $validated['diajukan_oleh'] = Auth::user()->id_user;
        $validated['status'] = 'pending';

        try {
            ModelsAspirasi::create($validated);
            Flux::modals()->close();
            $this->dispatch('alert', type: 'success', title: 'Sukses', text: 'Aspirasi berhasil ditambahkan!');
            $this->reset(['ditujukan_ke', 'aspirasi']);
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch('alert', type: 'error', title: 'Error', timer: 5000, text: $e->getMessage());
        }
    }

    public function edit(ModelsAspirasi $aspirasi)
    {
        $this->model_aspirasi = $aspirasi;
        $this->ditujukan_ke = $aspirasi->ditujukan_ke;
        $this->aspirasi = $aspirasi->aspirasi;
        Flux::modal('edit-admin')->show();
    }

    public function update()
    {
        $validated = $this->validate([
            'ditujukan_ke' => ['required'],
            'aspirasi' => ['required', 'string', 'max:3000'],
        ], [
            'ditujukan_ke.required' => 'Tujuan aspirasi harus dipilih!',
            'aspirasi.required' => 'Aspirasi harus diisi!',
            'aspirasi.max' => 'Aspirasi maksimal 3000 karakter',
            'aspirasi.string' => 'Aspirasi harus berupa teks!',
        ]);

        try {
            $this->model_aspirasi->update($validated);
            Flux::modals()->close();
            $this->dispatch('alert', type: 'success', title: 'Sukses', text: 'Data aspirasi berhasil diupdate!');
            $this->reset(['ditujukan_ke', 'aspirasi']);
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch('alert', type: 'error', title: 'Error', timer: 5000, text: $e->getMessage());
        }
    }

    #[On('delete')]
    public function delete(ModelsAspirasi $id)
    {
        $id->delete();

        $this->dispatch('alert', type: 'success', title: "Sukses", text: "Aspirasi berhasil dihapus!");
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirmDelete', type: 'question', title: 'Yakin hapus?', text: 'Tindakan ini tidak dapat dibatalkan!', id: $id);
    }
}
