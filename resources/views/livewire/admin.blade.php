<main class="p-1 min-w-full mx-auto space-y-6">
    @slot('title')
        Admin User
    @endslot
    <flux:fieldset>
        <flux:legend>Daftar Admin</flux:legend>
        <flux:description>Berikut adalah data Admin LPPM dari sistem ini.</flux:description>
        <div class="min-h-screen">
            <div class="flex justify-between items-center mb-4 ">
                <div class="flex gap-2">
                    <flux:input type="text" icon="magnifying-glass" kbd="⌘K" wire:model.live="search"
                        placeholder="Cari Admin..." class="w-full" size="xs" />
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
                        <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah Admin</flux:button>
                    </div>
                </flux:modal.trigger>
            </div>

            {{-- Add Admin Modal --}}
            <flux:modal name="add-admin" class="md:w-xl">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Add Admin</flux:heading>
                        <flux:text class="mt-2">Add an Admin for your system.</flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nim')" wire:model="nim" label="NIDN" placeholder="NIDN" />
                    <flux:input :invalid="$errors->has('full_name')" wire:model="full_name" label="Full Name"
                        placeholder="Full Name" />
                    {{-- <flux:select wire:model='gender' :invalid="$errors->has('gender')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="Laki-laki">Laki-laki</flux:select.option>
                        <flux:select.option value="Perempuan">Perempuan</flux:select.option>
                    </flux:select> --}}
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Save Admin</flux:button>
                    </div>
                </form>
            </flux:modal>

            {{-- Update Admin Modal --}}
            <flux:modal name="edit-admin" class="md:w-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit Admin</flux:heading>
                        <flux:text class="mt-2">Edit an Admin for your system.</flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nim')" wire:model="nim" label="NIDN" placeholder="NIDN" />
                    <flux:input :invalid="$errors->has('full_name')" wire:model="full_name" label="Full Name"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input :invalid="$errors->has('birthday')" wire:model="birthday" type="date"
                        label="Birthday" placeholder="Birthday" />
                    <flux:select placeholder="Gender" wire:model='gender' :invalid="$errors->has('gender')">
                        <flux:select.option value="Laki-laki">Laki-laki</flux:select.option>
                        <flux:select.option value="Perempuan">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('address')" wire:model="address" label="Address"
                        placeholder="Address" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Edit Admin</flux:button>
                    </div>
                </form>
            </flux:modal>

            <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
                <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-2 py-2 text-left">No</th>
                            <th class="px-2 py-2 text-left">Nama</th>
                            <th class="px-2 py-2 text-left">NIDN</th>
                            <th class="px-2 py-2 text-left">Peran</th>
                            <th class="px-2 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($users as $no => $participant)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $users->firstItem() + $no }}</td>
                                <td class="px-2 py-2 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $participant->avatar) }}"
                                        class="h-6 w-6 rounded-full" alt="avatar">
                                    <div>
                                        <div class="text-[0.7rem] font-semibold">{{ $participant->full_name }}</div>
                                        <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                            {{ $participant->email }}</div>
                                    </div>
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $participant->nim }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">
                                    {{ $participant->role->role_name }}</td>
                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">

                                                <flux:button wire:click="edit({{ $participant->id_user }})"
                                                    size="xs" icon="pencil" class="!text-[0.65rem]">
                                                    Edit
                                                </flux:button>
                                                <flux:button wire:click="confirmDelete({{ $participant->id_user }})"
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
