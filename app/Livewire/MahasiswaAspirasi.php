<?php

namespace App\Livewire;

use App\Models\Aspirasi as ModelsAspirasi;
use App\Models\AspirasiNote;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Rules\MaxWords;

class MahasiswaAspirasi extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $aspirasi;
    // public $ditujukan_ke;
    public $ke_warek;
    // public $aspirasi;
    // public $add_ditujukan_ke;
    public ModelsAspirasi $model_aspirasi;
    public $data_warek;
    public $note;

    public function render()
    {
        $this->data_warek = User::onlyWarek()->get();

        $aspirasis = ModelsAspirasi::with(['pengaju', 'yangDituju.role'])
            ->whereHas('pengaju', function ($q) {
                $q->where('id_user', Auth::user()->id_user);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('aspirasi', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.mahasiswa-aspirasi', [
            'data' => $aspirasis,
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'ke_warek' => ['required'],
            'aspirasi' => ['required', 'string', new MaxWords(250)],
        ], [
            'ke_warek.required' => 'Tujuan aspirasi harus dipilih!',
            'aspirasi.required' => 'Aspirasi harus diisi!',
            'aspirasi.max' => 'Aspirasi maksimal 250 karakter',
            'aspirasi.string' => 'Aspirasi harus berupa teks!',
        ]);

        $validated = [
            'diajukan_oleh' => Auth::user()->id_user,
            'ke_warek' => $validated['ke_warek'],
            'aspirasi' => $validated['aspirasi'],
            'status' => 'pending'
        ];
        try {
            ModelsAspirasi::create($validated);
            Flux::modals()->close();
            $this->dispatch('alert', type: 'success', title: 'Sukses', text: 'Aspirasi berhasil ditambahkan!');
            $this->reset(['ke_warek', 'aspirasi']);
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch('alert', type: 'error', title: 'Error', timer: 5000, text: $e->getMessage());
        }
    }

    public function edit(ModelsAspirasi $aspirasi)
    {
        $this->model_aspirasi = $aspirasi;
        $this->ke_warek = $aspirasi->ke_warek;
        $this->aspirasi = $aspirasi->aspirasi;
        Flux::modal('edit-aspirasi')->show();
    }

    public function update()
    {
        $validated = $this->validate([
            'ke_warek' => ['required'],
            'aspirasi' => ['required', 'string', 'max:3000'],
        ], [
            'ke_warek.required' => 'Tujuan aspirasi harus dipilih!',
            'aspirasi.required' => 'Aspirasi harus diisi!',
            'aspirasi.max' => 'Aspirasi maksimal 3000 karakter',
            'aspirasi.string' => 'Aspirasi harus berupa teks!',
        ]);

        try {
            $this->model_aspirasi->update($validated);
            Flux::modals()->close();
            $this->dispatch('alert', type: 'success', title: 'Sukses', text: 'Data aspirasi berhasil diupdate!');
            $this->reset(['ke_warek', 'aspirasi']);
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch('alert', type: 'error', title: 'Error', timer: 5000, text: $e->getMessage());
        }
    }

    #[On('delete')]
    public function delete(ModelsAspirasi $id)
    {
        try{
            $id->notes()->delete();
            $id->delete();
            $this->dispatch('alert', type: 'success', title: "Sukses", text: "Aspirasi berhasil dihapus!");
        } catch(\Exception $e){
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Kesalahan',
                text: "Terdapat kesalahan " . $e->getMessage()
            );
        }
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirmDelete', type: 'question', title: 'Yakin hapus?', text: 'Tindakan ini tidak dapat dibatalkan!', id: $id);
    }
}
