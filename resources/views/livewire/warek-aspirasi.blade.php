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
        <flux:legend>Daftar Aspirasi</flux:legend>
        <flux:description>Berikut adalah data aspirasi mahasiswa yang ditujukan ke anda!.</flux:description>
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
                <flux:modal.trigger name="add-aspirasi" class="mb-4">
                    <div class="flex gap-2">
                        <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah</flux:button>
                    </div>
                </flux:modal.trigger>
            </div>

            {{-- Add Aspirasi Modal --}}
            <flux:modal name="add-aspirasi" class="md:w-xl">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Buat Aspirasi</flux:heading>
                        <flux:text class="mt-2">Sampaikan aspirasi anda terkait Universitas Annuqayah!.</flux:text>
                    </div>
                    <flux:select wire:model='add_ditujukan_ke' :invalid="$errors->has('add_ditujukan_ke')">
                        <flux:select.option value="">Jabatan Warek</flux:select.option>
                        @foreach ($data_warek as $warek_data)
                            <flux:select.option value="{{ $warek_data->id_user }}">{{ $warek_data->role->role_name }} -
                                {{ $warek_data->full_name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:textarea :invalid="$errors->has('add_aspirasi')" wire:model="add_aspirasi" label="Aspirasi" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                    </div>
                </form>
            </flux:modal>

            {{-- Modal Aspirasi Notes --}}
            <flux:modal name="aspirasi-notes" class="md:w-xl" max-width='1xl'>
                <form wire:submit.prevent="commentAspirasi" class="space-y-6">
                    <!-- Header Section -->
                    <div class="text-center">
                        <flux:legend>
                            Catatan
                        </flux:legend>
                        <flux:text class="text-gray-600 dark:text-gray-400">
                            Berikan catatan terkait aspirasi yang diajukan!
                        </flux:text>
                    </div>

                    <!-- Note Field -->
                    <div class="space-y-2">
                        <flux:textarea wire:model="note" label="Note" rows="4"
                            placeholder="Berikan catatan terkait aspirasi yang diajukan..."
                            :invalid="$errors->has('note')" required></flux:textarea>
                    </div>
                    <flux:button type='submit'>Submit</flux:button>
                </form>
            </flux:modal>

            {{-- Update Aspirasi Modal --}}
            <flux:modal name="edit-aspirasi" class="md:w-xl">
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
                            <th class="px-2 py-2 text-left">Catatan</th>
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
                                    <div class="relative">
                                        <!-- Notes Button with Dropdown -->
                                        <flux:dropdown position="bottom" align="start">
                                            <!-- Dropdown Trigger Button -->
                                            <button
                                                class="group relative p-1 rounded-md transition-all duration-300 hover:bg-purple-50 dark:hover:bg-purple-900/20"
                                                title="View Notes" aria-label="View proposal notes">
                                                <!-- Notes Icon -->
                                                <svg class="w-5 h-5 text-purple-500 group-hover:text-purple-600 dark:text-purple-400 dark:group-hover:text-purple-300 transition-all duration-300 transform group-hover:scale-110"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>

                                                <!-- Note Count Badge -->
                                                <span class="absolute -top-2 -right-2 flex h-4 w-4">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-4 w-4 bg-purple-500 text-white text-[0.5rem] items-center justify-center">
                                                        {{ $data_aspirasi->notes->count() }}
                                                    </span>
                                                </span>
                                            </button>

                                            <!-- Dropdown Menu Content -->
                                            <flux:menu class="min-w-[200px] p-2">
                                                <div class="space-y-2">
                                                    @if ($data_aspirasi->notes->count() > 0)
                                                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                                            @forelse ($data_aspirasi->notes as $note)
                                                                <li class="transition-colors duration-150">
                                                                    <div class="flex items-start gap-1">
                                                                        <!-- Note Icon -->
                                                                        <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-400 dark:text-gray-500"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                                                        </svg>

                                                                        <!-- Note Content -->
                                                                        <div class="min-w-0 max-w-80">
                                                                            <p
                                                                                class="text-xs text-gray-800 dark:text-gray-200">
                                                                                {{ $note->note }}
                                                                            </p>

                                                                            <span class="flex">
                                                                                <p><small
                                                                                        class="text-blue-600 dark:text-green-600">{{ $note->user->id_user === Auth::user()->id_user ? 'Anda' : $note->user->full_name }}</small>
                                                                                    - </p>
                                                                                <!-- Note Metadata -->
                                                                                <time
                                                                                    datetime="{{ $note->created_at->toIso8601String() }}"
                                                                                    class="text-gray-300 text-xs">
                                                                                    <small>{{ $note->created_at->diffForHumans() }}</small>
                                                                                </time>
                                                                            </span>
                                                                            <flux:separator />
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @empty
                                                                <li class="py-4 text-center">
                                                                    <div
                                                                        class="inline-flex flex-col items-center justify-center gap-1 text-gray-500 dark:text-gray-400">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="size-5">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                                        </svg>
                                                                        <p class="text-xs">No notes available</p>
                                                                    </div>
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    @else
                                                        <span
                                                            class="inline-flex flex-row items-center justify-center gap-1 text-center p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="size-5 text-gray-400 dark:text-gray-500"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                            </svg>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                No notes available
                                                            </p>
                                                        </span>
                                                    @endif
                                                </div>
                                            </flux:menu>
                                        </flux:dropdown>
                                    </div>
                                </td>
                                <td class="px-2 py-2">
                                    @if ($data_aspirasi->status === 'pending')
                                        <span
                                            class="!text-[0.65rem] inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pending
                                        </span>
                                    @elseif($data_aspirasi->status === 'accepted')
                                        <span
                                            class="!text-[0.65rem] inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Accepted
                                        </span>
                                    @elseif($data_aspirasi->status === 'rejected')
                                        <span
                                            class="!text-[0.65rem] inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <!-- Pending State Actions -->
                                                @if ($data_aspirasi->status === 'pending')
                                                    <flux:button
                                                        wire:click="approveAspirasi({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="check-circle"
                                                        class="!text-[0.65rem] cursor-pointer text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all hover:scale-[1.02]">
                                                        Terima
                                                    </flux:button>
                                                    <flux:button
                                                        wire:click="rejectAspirasi({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="x-circle"
                                                        class="!text-[0.65rem] cursor-pointer text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all hover:scale-[1.02]">
                                                        Tolak
                                                    </flux:button>
                                                    <flux:button
                                                        wire:click="comment({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="chat-bubble-left-ellipsis"
                                                        class="!text-[0.65rem]">
                                                        Komentar
                                                    </flux:button>

                                                    <!-- Accepted State Actions -->
                                                @elseif($data_aspirasi->status === 'accepted')
                                                    <flux:button
                                                        wire:click="markAsPending({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="clock"
                                                        class="!text-[0.65rem] cursor-pointer text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all hover:scale-[1.02]">
                                                        Pending
                                                    </flux:button>
                                                    <!-- Rejected State Actions -->
                                                @elseif($data_aspirasi->status === 'rejected')
                                                    <flux:button
                                                        wire:click="approveAspirasi({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="check-circle"
                                                        class="!text-[0.65rem] cursor-pointer text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all hover:scale-[1.02]">
                                                        Terima
                                                    </flux:button>
                                                    <flux:button
                                                        wire:click="comment({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="chat-bubble-left-ellipsis"
                                                        class="!text-[0.65rem]">
                                                        Komentar
                                                    </flux:button>
                                                    <!-- commented State Actions -->
                                                @elseif($data_aspirasi->status === 'commented')
                                                    <flux:button
                                                        wire:click="approveAspirasi({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="check-circle"
                                                        class="!text-[0.65rem] cursor-pointer text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all hover:scale-[1.02]">
                                                        Terima
                                                    </flux:button>
                                                    <flux:button
                                                        wire:click="rejectAspirasi({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="x-circle"
                                                        class="!text-[0.65rem] cursor-pointer text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all hover:scale-[1.02]">
                                                        Tolak
                                                    </flux:button>
                                                    <flux:button
                                                        wire:click="comment({{ $data_aspirasi->id_aspirasi }})"
                                                        size="xs" icon="chat-bubble-left-ellipsis"
                                                        class="!text-[0.65rem]">
                                                        Komentar
                                                    </flux:button>
                                                @endif
                                                <flux:separator/>
                                                <flux:button
                                                    wire:click="edit({{ $data_aspirasi->id_aspirasi }})"
                                                    size="xs" icon="pencil-square"
                                                    class="!text-[0.65rem] cursor-pointer text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all hover:scale-[1.02]">
                                                    Edit
                                                </flux:button>
                                                <flux:button
                                                    wire:click="confirmDelete({{ $data_aspirasi->id_aspirasi }})"
                                                    size="xs" icon="trash"
                                                    variant="danger"
                                                    class="!text-[0.65rem] cursor-pointer text-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all hover:scale-[1.02]">
                                                    Hapus
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-2 py-6 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <!-- Animated document icon -->
                                        <div class="relative">
                                            <svg class="w-12 h-12 text-green-400 dark:text-green-500 animate-bounce"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <div class="absolute -top-1 -right-1">
                                                <span class="relative flex h-3 w-3">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Text content -->
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Belum ada
                                                aspirasi</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Buat aspirasi pertama
                                                anda terkait Universitas Annuqayah</p>
                                        </div>
                                    </div>
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
