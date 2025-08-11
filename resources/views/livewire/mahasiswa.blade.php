<main class="p-1 min-w-full mx-auto space-y-6">
    @slot('title')
        Mahasiswa User
    @endslot
    <flux:fieldset>
        <flux:legend>Daftar Mahasiswa</flux:legend>
        <flux:description>Berikut adalah data mahasiswa dari sistem anda!.</flux:description>
        <div class="min-h-screen">
            <div class="flex justify-between items-center mb-4 ">
                <div class="flex gap-2">
                    <flux:input type="text" icon="magnifying-glass" kbd="⌘K" wire:model.live="search"
                        placeholder="Cari Mahasiswa..." class="w-full" size="xs" />
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
                        <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah Mahsiswa</flux:button>
                    </div>
                </flux:modal.trigger>
            </div>

            {{-- Add Admin Modal --}}
            <flux:modal name="add-admin" class="md:w-xl">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Tambah Mahasiswa</flux:heading>
                        <flux:text class="mt-2">Tambahkan mahasiswa pada sistem anda!.</flux:text>
                    </div>
                    <flux:input icon="credit-card" :invalid="$errors->has('nim')" wire:model="nim" label="NIM"
                        placeholder="NIDN" />
                    <flux:input icon="user" :invalid="$errors->has('full_name')" wire:model="full_name" label="Nama Lengkap"
                        placeholder="Nama Lengkap" />
                    <flux:input icon="key" :invalid="$errors->has('password')" wire:model="password"
                        label="Password" placeholder="Password" type='password' viewable />
                    <flux:select wire:model="prodi" :invalid="$errors->has('prodi')" placeholder="Program Studi">
                        <flux:select.option value="Ilmu Al-Quran & Tafsir">Ilmu Al-Quran & Tafsir</flux:select.option>
                        <flux:select.option value="Tasawuf dan Psikoterapi">Tasawuf dan Psikoterapi</flux:select.option>
                        <flux:select.option value="Hukum Keluarga Islam">Hukum Keluarga Islam</flux:select.option>
                        <flux:select.option value="Teknik Sipil">Teknik Sipil</flux:select.option>
                        <flux:select.option value="Pendidikan Agama Islam">Pendidikan Agama Islam</flux:select.option>
                        <flux:select.option value="Ekonomi Syariah">Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Pendidikan Islam Anak Usia Dini">Pendidikan Islam Anak Usia Dini</flux:select.option>
                        <flux:select.option value="Perbankan Syariah">Perbankan Syariah</flux:select.option>
                        <flux:select.option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</flux:select.option>
                        <flux:select.option value="Biologi">Biologi</flux:select.option>
                        <flux:select.option value="Matematika">Matematika</flux:select.option>
                        <flux:select.option value="Kimia">Kimia</flux:select.option>
                        <flux:select.option value="Teknologi Informasi">Teknologi Informasi</flux:select.option>
                        <flux:select.option value="Teknologi Hasil Pertanian">Teknologi Hasil Pertanian</flux:select.option>
                        <flux:select.option value="Bisnis Digital">Bisnis Digital</flux:select.option>
                        <flux:select.option value="Ilmu Komunikasi">Ilmu Komunikasi</flux:select.option>
                    </flux:select>
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
                        <flux:heading size="lg">Update Mahasiswa</flux:heading>
                        <flux:text class="mt-2">Update data mahasiswa pada sistem anda!.</flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nim')" wire:model="nim" label="NIM" placeholder="NIDN" />
                    <flux:input :invalid="$errors->has('full_name')" wire:model="full_name" label="Full Name"
                        placeholder="Full Name" />
                    <flux:select wire:model="prodi" :invalid="$errors->has('prodi')" placeholder="Program Studi">
                        <flux:select.option value="Ilmu Al-Quran & Tafsir">Ilmu Al-Quran & Tafsir</flux:select.option>
                        <flux:select.option value="Tasawuf dan Psikoterapi">Tasawuf dan Psikoterapi</flux:select.option>
                        <flux:select.option value="Hukum Keluarga Islam">Hukum Keluarga Islam</flux:select.option>
                        <flux:select.option value="Teknik Sipil">Teknik Sipil</flux:select.option>
                        <flux:select.option value="Pendidikan Agama Islam">Pendidikan Agama Islam</flux:select.option>
                        <flux:select.option value="Ekonomi Syariah">Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Pendidikan Islam Anak Usia Dini">Pendidikan Islam Anak Usia Dini</flux:select.option>
                        <flux:select.option value="Perbankan Syariah">Perbankan Syariah</flux:select.option>
                        <flux:select.option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</flux:select.option>
                        <flux:select.option value="Biologi">Biologi</flux:select.option>
                        <flux:select.option value="Matematika">Matematika</flux:select.option>
                        <flux:select.option value="Kimia">Kimia</flux:select.option>
                        <flux:select.option value="Teknologi Informasi">Teknologi Informasi</flux:select.option>
                        <flux:select.option value="Teknologi Hasil Pertanian">Teknologi Hasil Pertanian</flux:select.option>
                        <flux:select.option value="Bisnis Digital">Bisnis Digital</flux:select.option>
                        <flux:select.option value="Ilmu Komunikasi">Ilmu Komunikasi</flux:select.option>
                    </flux:select>
                    <flux:input icon="key" :invalid="$errors->has('password')" wire:model="password"
                        label="Password" placeholder="Password" type='password' viewable />
                    {{-- <flux:select placeholder="Gender" wire:model='gender' :invalid="$errors->has('gender')">
                        <flux:select.option value="Laki-laki">Laki-laki</flux:select.option>
                        <flux:select.option value="Perempuan">Perempuan</flux:select.option>
                    </flux:select> --}}
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
                            <th class="px-2 py-2 text-left">Prodi</th>
                            <th class="px-2 py-2 text-left">NIM</th>
                            <th class="px-2 py-2 text-left">Peran</th>
                            <th class="px-2 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($users as $no => $admin)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $users->firstItem() + $no }}</td>
                                <td class="px-2 py-2">
                                    {{ $admin->full_name }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $admin->prodi ?? '-' }}
                                <td class="px-2 py-2 text-[0.7rem]">{{ $admin->nim }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">
                                    {{ $admin->role->role_name }}</td>
                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">

                                                <flux:button wire:click="edit({{ $admin->id_user }})" size="xs"
                                                    icon="pencil" class="!text-[0.65rem]">
                                                    Edit
                                                </flux:button>
                                                @if ($admin->id_user !== Auth::user()->id_user)
                                                    <flux:button wire:click="confirmDelete({{ $admin->id_user }})"
                                                        size="xs" icon="trash" class="!text-[0.65rem]">
                                                        Hapus
                                                    </flux:button>
                                                @endif
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"
                                    class="px-2 py-3 text-center text-[0.7rem] text-gray-500 dark:text-gray-400">Belum
                                    ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-sm mt-2">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </flux:fieldset>
</main>
