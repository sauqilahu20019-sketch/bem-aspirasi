<main class="p-1 min-w-full mx-auto space-y-6">
    @slot('title')
        Aspirasi
    @endslot
    @push('styles')
        <style>
            .status-badge {
                --blink-opacity: 0.7;
                position: relative;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
                transform-origin: center;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            .status-badge::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: linear-gradient(to bottom right,
                        rgba(255, 255, 255, var(--blink-opacity)) 0%,
                        rgba(255, 255, 255, 0) 60%);
                transform: rotate(30deg);
                transition: all 0.6s ease;
                opacity: 0;
            }

            .status-badge:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.1);
            }

            .status-badge:hover::before {
                opacity: 1;
                animation: shine 1.5s ease infinite;
            }

            /* Pending Animation */
            .status-badge-pending {
                --pulse-color: rgba(234, 179, 8, 0.4);
            }

            /* Accepted Animation */
            .status-badge-accepted {
                --pulse-color: rgba(16, 185, 129, 0.4);
            }

            /* Rejected Animation */
            .status-badge-rejected {
                --pulse-color: rgba(244, 63, 94, 0.4);
            }

            @keyframes pulse {

                0%,
                100% {
                    box-shadow: 0 0 0 0 var(--pulse-color);
                }

                50% {
                    box-shadow: 0 0 0 6px transparent;
                }
            }

            @keyframes shine {
                0% {
                    transform: rotate(30deg) translate(-30%, -30%);
                }

                100% {
                    transform: rotate(30deg) translate(30%, 30%);
                }
            }
        </style>
    @endpush
    <flux:fieldset>
        <flux:legend>Daftar Wakil Rektor</flux:legend>
        <flux:description>Berikut adalah data Wakil Rektor Universitas Annuqayah.</flux:description>
        <div class="min-h-screen">
            <div class="flex justify-between items-center mb-4 ">
                <div class="flex gap-2">
                    <flux:input type="text" icon="magnifying-glass" kbd="⌘K" wire:model.live="search"
                        placeholder="Cari Aspirasi..." class="w-full" size="xs" />
                    <div>
                        <flux:select size="xs" placeholder="Per Page" wire:model.live='perPage'>
                            <flux:select.option value="5">5</flux:select.option>
                            <flux:select.option value="7">7</flux:select.option>
                            <flux:select.option value="10">10</flux:select.option>
                            <flux:select.option value="20">20</flux:select.option>
                            <flux:select.option value="30">30</flux:select.option>
                            <flux:select.option value="50">50</flux:select.option>
                            <flux:select.option value="100">100</flux:select.option>
                        </flux:select>
                    </div>
                </div>
                <flux:modal.trigger name="add-admin" class="mb-4">
                    <div class="flex gap-2">
                        <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah Warek</flux:button>
                    </div>
                </flux:modal.trigger>
            </div>

            {{-- Add Admin Modal --}}
            <flux:modal name="add-admin" class="md:w-xl">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Tambah Wakil Rektor</flux:heading>
                        <flux:text class="mt-2">Tambahkan data Wakil Rektor untuk sistem anda!.</flux:text>
                    </div>
                    <flux:input icon="credit-card" :invalid="$errors->has('nim')" wire:model="nim" label="NIDN"
                        placeholder="NIDN" />
                    <flux:input icon="user" :invalid="$errors->has('full_name')" wire:model="full_name"
                        label="Full Name" placeholder="Full Name" />
                    <flux:select wire:model='role_id' :invalid="$errors->has('role_id')">
                        <flux:select.option value="">Jabatan Warek</flux:select.option>
                        <flux:select.option value="3">Wakil Rektor I - Akademik</flux:select.option>
                        <flux:select.option value="4">Wakil Rektor II - Keuangan</flux:select.option>
                        <flux:select.option value="5">Wakil Rektor III - Kemahasiswaan</flux:select.option>
                        <flux:select.option value="6">Wakil Rektor IV - HUMAS</flux:select.option>
                    </flux:select>
                    {{-- <flux:textarea :invalid="$errors->has('description')" wire:model="description" label="Deskripsi"
                        placeholder="Description" type='text' /> --}}
                    <flux:input icon="key" :invalid="$errors->has('password')" wire:model="password"
                        label="Password" placeholder="Password" type='password' viewable />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                    </div>
                </form>
            </flux:modal>

            {{-- Update Admin Modal --}}
            <flux:modal name="edit-admin" class="md:w-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Update Data Aspirasi</flux:heading>
                        <flux:text class="mt-2">Update data aspirasi mahasiswa pada sistem anda!.</flux:text>
                    </div>
                    <flux:select wire:model='ditujukan_ke' :invalid="$errors->has('ditujukan_ke')">
                        <flux:select.option value="">Jabatan Warek</flux:select.option>
                        @foreach ($data_warek as $warek_data)
                            <flux:select.option value="{{ $warek_data->id_user }}">{{ $warek_data->role->role_name }} -
                                {{ $warek_data->full_name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:textarea :invalid="$errors->has('aspirasi')" wire:model="aspirasi" label="Aspirasi" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Update</flux:button>
                    </div>
                </form>
            </flux:modal>

            <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
                <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-2 py-2 text-left">No</th>
                            <th class="px-2 py-2 text-left">Nama</th>
                            <th class="px-2 py-2 text-left">Aspirasi</th>
                            <th class="px-2 py-2 text-left">Ditujukan Ke</th>
                            <th class="px-2 py-2 text-left">Status</th>
                            <th class="px-2 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($data as $no => $data_aspirasi)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2 flex flex-col">
                                    <div class="text-[0.7rem] font-semibold">{{ $data_aspirasi->pengaju->full_name }}
                                    </div>
                                    <small class="text-[0.6rem]">
                                        {{ $data_aspirasi->pengaju->nim }} -
                                        {{ getProdiAcronym($data_aspirasi->pengaju->prodi) }}
                                    </small>
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $data_aspirasi->aspirasi }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">
                                    {{ $data_aspirasi->yangDituju->full_name }} -
                                    {{ $data_aspirasi->yangDituju->role->role_name }}
                                </td>

                                <td class="px-2 py-2">
                                    <span>{{ $data_aspirasi->status }}</span>
                                </td>

                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <flux:button wire:click="edit({{ $data_aspirasi->id_aspirasi }})"
                                                    size="xs" icon="pencil" class="!text-[0.65rem]">
                                                    Edit
                                                </flux:button>
                                                <flux:button
                                                    wire:click="confirmDelete({{ $data_aspirasi->id_aspirasi }})"
                                                    size="xs" icon="trash" class="!text-[0.65rem]">
                                                    Hapus
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"
                                    class="px-2 py-3 text-center text-[0.7rem] text-gray-500 dark:text-gray-400">
                                    Belum ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="text-sm mt-2">
                {{ $data->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </flux:fieldset>
</main>
