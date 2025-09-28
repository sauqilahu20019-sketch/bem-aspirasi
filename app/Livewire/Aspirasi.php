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

class Aspirasi extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $ditujukan_ke;
    public ModelsAspirasi $model_aspirasi;
    public $data_warek;
    public $note;
    public $searchWarek = null;
    public $searchWarekResults = null;

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

    public function updatedSearchWarek()
    {
        $validated = $this->validate(['searchWarek' => 'string|max:255']);

        if (strlen($validated['searchWarek']) >= 2) {
            $this->searchWarekResults = User::onlyWarek()
                ->where(function ($q) {
                    $q->where('nidn', 'like', '%' . $this->searchWarek . '%')
                        ->orWhere('full_name', 'like', '%' . $this->searchWarek . '%');
                })
                ->get();
        } else {
            $this->searchWarekResults = null;
        }
    }

    public function assignWarek(ModelsAspirasi $aspirasi)
    {
        $this->model_aspirasi = $aspirasi;
        Flux::modal('assign-warek')->show();
    }

    public function setWarek(User $user)
    {
        if (!$this->model_aspirasi) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal!',
                text: 'Belum ada Warek yang dipilih.'
            );
            return;
        }
        $this->model_aspirasi->update([
            'ditujukan_ke' => $user->id_user
        ]);
        $this->refreshData();
        Flux::modals()->close();

        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Berhasil!',
            text: 'Dosen berhasil ditetapkan sebagai DPL.'
        );
    }

    #[On('delete')]
    public function delete(ModelsAspirasi $id)
    {
        $id->delete();
        $this->refreshData();
        $this->dispatch('alert', type: 'success', title: "Sukses", text: "Aspirasi berhasil dihapus!");
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirmDelete', type: 'question', title: 'Yakin hapus?', text: 'Tindakan ini tidak dapat dibatalkan!', id: $id);
    }

    public function comment(ModelsAspirasi $aspirasi)
    {
        $this->model_aspirasi = $aspirasi;
        Flux::modal('aspirasi-notes')->show();
    }

    public function commentReject(ModelsAspirasi $aspirasi)
    {
        $this->model_aspirasi = $aspirasi;
        Flux::modal('reject-notes')->show();
    }

    public function commentAspirasi()
    {
        $validated = $this->validate([
            'note' => ['required', 'string', 'max:2000']
        ]);
        $validated['aspirasi_id'] = $this->model_aspirasi->id_aspirasi;
        $validated['oleh'] = Auth::user()->id_user;
        try {
            AspirasiNote::create($validated);
            Flux::modals()->close();
            $this->refreshData();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Catatan berhasil disimpan!'
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                time: 5000,
                text: $e->getMessage()
            );
        }
    }

    public function approveAspirasi(ModelsAspirasi $aspirasi)
    {
        $aspirasi->update(['status' => 'accepted']);
        $this->refreshData();
    }

    public function rejectAspirasi()
    {
        $validated = $this->validate([
            'note' => ['required', 'string', 'max:2000']
        ]);
        $validated['aspirasi_id'] = $this->model_aspirasi->id_aspirasi;
        $validated['oleh'] = Auth::user()->id_user;

        try {
            AspirasiNote::create($validated);
            $this->model_aspirasi->update(['status' => 'rejected']);

            Flux::modals()->close();
            $this->refreshData();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Catatan Tolakan berhasil disimpan!'
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                time: 5000,
                text: $e->getMessage()
            );
        }
    }

    public function markAsPending(ModelsAspirasi $aspirasi)
    {
        $aspirasi->update(['status' => 'pending']);
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->search = '';
        $this->ditujukan_ke = '';
        $this->data_warek = '';
        $this->note = '';
    }
}
