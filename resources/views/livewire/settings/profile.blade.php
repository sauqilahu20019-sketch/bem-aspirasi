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
            <div>
                <flux:select :label="__('Program Studi')" wire:model="prodi" :invalid="$errors->has('prodi')" placeholder="Program Studi">
                    <flux:select.option value="Teknik Hasil Pertanian">Teknik Hasil Pertanian</flux:select.option>
                    <flux:select.option value="Teknologi  Informasi">Teknologi Informasi</flux:select.option>
                    <flux:select.option value="Teknik Sipil">Teknik Sipil</flux:select.option>
                </flux:select>
            </div>

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
