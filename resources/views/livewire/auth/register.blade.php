<div class="flex flex-col md:flex-row bg-white dark:bg-gray-900 items-center min-h-screen">
    <!-- Container 1: Ilustrasi SVG Animasi (now on left) -->
    <div class="relative text-center max-w-lg mx-auto">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex md:mb-5  flex-col items-center gap-1" wire:navigate>
            <span class="flex items-center justify-center rounded-md">
                <x-app-logo-icon class="w-20 md:w-56" />
            </span>
        </a>

        <!-- Animated Welcome Text -->
        <h1 class="text-3xl md:text-3xl font-bold text-indigo-800 dark:text-indigo-100 leading-snug">
            <span id="typing-title" class="relative inline-block">
                <span class="typing-cursor"></span>
            </span>
        </h1>

        <!-- Animated Subtitle -->
        <h3 class="text-sm md:text-xl text-indigo-600 dark:text-indigo-300/90 font-medium">
            <span id="typing-subtitle" class="opacity-0"></span>
        </h3>

        <!-- Additional Info Text -->
        <p class="text-sm md:text-xl text-indigo-500 dark:text-indigo-400/80">
            <span id="typing-info" class="opacity-0"></span>
        </p>
    </div>

    <!-- Container 2: Form Daftar (now on right) -->
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
                        <flux:input :invalid="$errors->has('initial_name')" wire:model="initial_name" icon="user"
                            type="text" required placeholder="Nama depan" />
                        @error('initial_name')
                            <div class="flex items-center pt-1">
                                <span class="flex gap-2 items-center">
                                    <svg class="w-[18px] h-[18px] text-red-600 dark:text-red-600" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <p class="text-xs text-red-600 font-bold">
                                        {{ $message }}
                                    </p>
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                            Belakang</label>
                        <flux:input wire:model="last_name" :invalid="$errors->has('last_name')" type="text"
                            placeholder="Nama belakang (opsional)" />
                        @error('last_name')
                            <div class="flex items-center pt-1">
                                <span class="flex gap-2 items-center">
                                    <svg class="w-[18px] h-[18px] text-red-600 dark:text-red-600" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <p class="text-xs text-red-600 font-bold">
                                        {{ $message }}
                                    </p>
                                </span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">NIM</label>
                    <flux:input wire:model="nim" :invalid="$errors->has('nim')" icon="credit-card" type="text"
                        required placeholder="Nomor Induk Mahasiswa" />

                    @error('nim')
                        <div class="flex items-center pt-1">
                            <span class="flex gap-2 items-center">
                                <svg class="w-[18px] h-[18px] text-red-600 dark:text-red-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="text-xs text-red-600 font-bold">
                                    {{ $message }}
                                </p>
                            </span>
                        </div>
                    @enderror
                </div>

                <div>
                    <flux:select wire:model="prodi" :invalid="$errors->has('prodi')" placeholder="Program Studi">
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
                    @error('prodi')
                        <div class="flex items-center pt-1">
                            <span class="flex gap-2 items-center">
                                <svg class="w-[18px] h-[18px] text-red-600 dark:text-red-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="text-xs text-red-600 font-bold">
                                    {{ $message }}
                                </p>
                            </span>
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <flux:input wire:model="password" icon="key" viewable type="password" required
                        placeholder="Minimal 8 karakter" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi
                        Password</label>
                    <flux:input wire:model="password_confirmation" :invalid="$errors->has('password')" icon="key"
                        viewable type="password" required placeholder="Ulangi password anda" />
                    @error('password')
                        <div class="flex items-center pt-1">
                            <span class="flex gap-2 items-center">
                                <svg class="w-[18px] h-[18px] text-red-600 dark:text-red-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="text-xs text-red-600 font-bold">
                                    {{ $message }}
                                </p>
                            </span>
                        </div>
                    @enderror
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
            const titleText = "Welcome to SIAP BEM";
            const subtitleText = "Sistem Informasi Aspirasi Mahasiswa BEM-KM";
            const infoText = "Universitas Annuqayah";

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
                        const subtitleElement = document.getElementById('typing-subtitle');
                        subtitleElement.classList.remove('opacity-0');
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

                                // Start typing info text
                                setTimeout(() => {
                                    const infoElement = document.getElementById(
                                        'typing-info');
                                    infoElement.classList.remove('opacity-0');
                                    infoElement.innerHTML =
                                        '<span class="typing-cursor">|</span>';

                                    let k = 0;
                                    const typeInfo = () => {
                                        if (k < infoText.length) {
                                            // Insert character before cursor
                                            const charSpan = document.createElement(
                                                'span');
                                            charSpan.textContent = infoText.charAt(k);
                                            charSpan.className = 'typed-char';

                                            const cursor = infoElement.querySelector(
                                                '.typing-cursor');
                                            infoElement.insertBefore(charSpan, cursor);

                                            k++;
                                            setTimeout(typeInfo, 70);
                                        } else {
                                            // Remove cursor when done
                                            const cursor = infoElement.querySelector(
                                                '.typing-cursor');
                                            if (cursor) cursor.remove();
                                        }
                                    };
                                    typeInfo();
                                }, 500);
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
