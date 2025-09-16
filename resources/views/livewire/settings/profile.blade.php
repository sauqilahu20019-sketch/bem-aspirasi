<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="full_name" :label="__('Nama Lengkap')" type="text" required autofocus
                autocomplete="full_name" />

            <div>
                <flux:input wire:model="nim" :label="__('NIM')" type="text" required autocomplete="nim" />

                {{-- @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif --}}
            </div>
            @can('is_mahasiswa')
                <div>
                    <flux:select :label="__('Program Studi')" wire:model="prodi" :invalid="$errors->has('prodi')"
                        placeholder="Program Studi">
                        <flux:select.option value="Ekonomi Syariah">Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Perbankan Syariah">Perbankan Syariah</flux:select.option>
                        <flux:select.option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</flux:select.option>
                        <flux:select.option value="Hukum Keluarga Islam">Hukum Keluarga Islam</flux:select.option>
                        <flux:select.option value="Pendidikan Agama Islam">Pendidikan Agama Islam</flux:select.option>
                        <flux:select.option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</flux:select.option>
                        <flux:select.option value="Pendidikan Islam Anak Usia Dini">Pendidikan Islam Anak Usia Dini
                        </flux:select.option>
                        <flux:select.option value="Ilmu Al-Quran & Tafsir">Ilmu Al-Quran & Tafsir</flux:select.option>
                        <flux:select.option value="Tasawuf dan Psikoterapi">Tasawuf dan Psikoterapi</flux:select.option>
                        <flux:select.option value="Biologi">Biologi</flux:select.option>
                        <flux:select.option value="Kimia">Kimia</flux:select.option>
                        <flux:select.option value="Matematika">Matematika</flux:select.option>
                        <flux:select.option value="Teknik Sipil">Teknik Sipil</flux:select.option>
                        <flux:select.option value="Teknologi Informasi">Teknologi Informasi</flux:select.option>
                        <flux:select.option value="Teknologi Hasil Pertanian">Teknologi Hasil Pertanian
                        </flux:select.option>
                        <flux:select.option value="Bisnis Digital">Bisnis Digital</flux:select.option>
                        <flux:select.option value="Ilmu Komunikasi">Ilmu Komunikasi</flux:select.option>
                    </flux:select>
                </div>
            @endcan

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
