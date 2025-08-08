<div class="flex flex-col md:flex-row bg-white dark:bg-gray-900">
    <!-- Container 2: Ilustrasi SVG Animasi (now on left) -->
    <div
        class="flex-col w-full md:w-1/2 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/30 flex items-center justify-center p-4  overflow-hidden order-1 md:order-none">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1" wire:navigate>
            <span class="flex items-center justify-center rounded-md">
                {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="BEM Logo"> --}}
                <x-app-logo-icon />
            </span>
        </a>
        <div class="text-center max-w-lg">
            <!-- Animated Welcome Text -->
            <h1 class="text-xl md:text-2xl font-bold text-indigo-800 dark:text-indigo-100 leading-snug">
                <span id="typing-title" class="relative inline-block">
                    <span
                        class="absolute -right-2 top-0 w-0.5 h-6 bg-indigo-600 dark:bg-indigo-300 animate-pulse"></span>
                </span>
            </h1>

            <!-- Animated Subtitle -->
            <h3 class="text-sm md:text-base text-indigo-600 dark:text-indigo-300/90 font-medium">
                <span id="typing-subtitle" class="opacity-0"></span>
            </h3>
        </div>
    </div>

    <!-- Container 1: Form Daftar (now on right) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 order-2 md:order-none">
        <div class="w-full max-w-md space-y-6">
            <!-- Judul -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-1">Buat Akun Baru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Daftar untuk mulai mengajukan aspirasi</p>
            </div>

            <!-- Form Daftar -->
            <form wire:submit="register" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                            Depan</label>
                        <flux:input :invalid="$errors->has('initial_name')"  wire:model="initial_name" icon="user" type="text" required placeholder="Nama depan" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                            Belakang</label>
                        <flux:input wire:model="last_name" :invalid="$errors->has('last_name')" type="text" placeholder="Nama belakang (opsional)" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">NIM</label>
                    <flux:input wire:model="nim" :invalid="$errors->has('nim')" icon="credit-card" type="text" required placeholder="Nomor Induk Mahasiswa" />
                </div>

                <div>
                    <flux:select wire:model="prodi" :invalid="$errors->has('prodi')" placeholder="Program Studi">
                        <flux:select.option value="teknologi  informasi">Teknologi Informasi</flux:select.option>
                    </flux:select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <flux:input wire:model="password" :invalid="$errors->has('password')"  icon="key" viewable type="password" required placeholder="Minimal 8 karakter" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi
                        Password</label>
                    <flux:input wire:model="password_confirmation" :invalid="$errors->has('password_confirmation')" icon="key" viewable type="password" required placeholder="Ulangi password anda" />
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms"
                        class="h-3.5 w-3.5 text-indigo-600 dark:text-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-600 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-800">
                    <label for="terms" class="ml-2 block text-xs text-gray-700 dark:text-gray-300">
                        Saya menyetujui <a href="#"
                            class="text-indigo-600 dark:text-indigo-400 hover:underline">Syarat & Ketentuan</a>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 text-sm bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 transition duration-200">
                    Daftar
                </button>
            </form>

            <div
                class="pt-4 text-center text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="cursor-pointer font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Masuk
                    disini</a>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleText = "BEM-KM Universitas Annuqayah";
            const subtitleText = "Kabinet Garda Muda";

            // Clear existing content and add cursor
            const titleElement = document.getElementById('typing-title');
            titleElement.innerHTML = '<span class="typing-cursor">|</span>';

            // Type title
            let i = 0;
            const typeTitle = () => {
                if (i < titleText.length) {
                    // Insert character before cursor
                    const charSpan = document.createElement('span');
                    charSpan.textContent = titleText.charAt(i);
                    charSpan.className = 'typed-char';

                    const cursor = titleElement.querySelector('.typing-cursor');
                    titleElement.insertBefore(charSpan, cursor);

                    i++;
                    setTimeout(typeTitle, 100);
                } else {
                    // When title finishes, start subtitle
                    setTimeout(() => {
                        document.getElementById('typing-subtitle').classList.remove('opacity-0');
                        const subtitleElement = document.getElementById('typing-subtitle');
                        subtitleElement.innerHTML = '<span class="typing-cursor">|</span>';

                        let j = 0;
                        const typeSubtitle = () => {
                            if (j < subtitleText.length) {
                                // Insert character before cursor
                                const charSpan = document.createElement('span');
                                charSpan.textContent = subtitleText.charAt(j);
                                charSpan.className = 'typed-char';

                                const cursor = subtitleElement.querySelector('.typing-cursor');
                                subtitleElement.insertBefore(charSpan, cursor);

                                j++;
                                setTimeout(typeSubtitle, 50);
                            } else {
                                // Remove cursor when done
                                const cursor = subtitleElement.querySelector('.typing-cursor');
                                if (cursor) cursor.remove();
                            }
                        };
                        typeSubtitle();
                    }, 500);

                    // Remove title cursor when moving to subtitle
                    const titleCursor = titleElement.querySelector('.typing-cursor');
                    if (titleCursor) titleCursor.remove();
                }
            };
            setTimeout(typeTitle, 500);
        });
    </script>
@endpush

@push('styles')
    <style>
        .typing-cursor {
            display: inline-block;
            animation: blink 1s step-end infinite;
            color: #4f46e5;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .typed-char {
            display: inline-block;
            animation: pop-in 0.1s ease-out;
        }

        @keyframes pop-in {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Floating animations */
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-6px) translateX(3px);
            }
        }

        @keyframes float-slower {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(5px) translateX(-3px);
            }
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .animate-float-slower {
            animation: float-slower 10s ease-in-out infinite;
        }
    </style>
@endpush
