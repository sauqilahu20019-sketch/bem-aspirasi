<div class="min-h-screen flex flex-col md:flex-row bg-white items-center dark:bg-gray-900">
    <!-- Container 1: Form Login -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="mb-5 flex flex-col items-center gap-1 font-medium" wire:navigate>
                <span class="flex p-4 rounded-md items-center justify-center bg-gray-50 dark:bg-white ">
                    <x-app-logo-icon class="w-24 fill-current text-black dark:text-white" />
                </span>
            </a>

            <!-- Judul -->
            <div class="text-center mb-5">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Selamat Datang</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Login untuk mengakses akun Anda</p>
            </div>

            <!-- Form Login -->
            <form wire:submit.prevent='login' class="space-y-4">
                <div>
                    <label for="nim"
                        class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">NIM</label>
                    <flux:input wire:model="nim" autofocus :invalid="$errors->has('nim')" icon="user" type="text"
                        required placeholder="Masukkan NIM" />
                    @error('nim')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <label for="password"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <a href="#"
                            class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Lupa
                            password?</a>
                    </div>
                    <flux:input :invalid="$errors->has('password')" wire:model="password" icon="key" viewable
                        type="password" required placeholder="Masukkan password anda" />
                </div>

                <div class="flex items-center">
                    <input wire:model="remember" type="checkbox" id="remember"
                        class="h-3.5 w-3.5 text-indigo-600 dark:text-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-600 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-800">
                    <label for="remember" class="ml-2 block text-xs text-gray-700 dark:text-gray-300">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 text-sm bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 transition duration-200">
                    Masuk
                </button>
            </form>

            {{-- <div
                class="pt-4 text-center text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                Belum punya akun? <a href="{{ route('register') }}"
                    class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Daftar
                    sekarang</a>
            </div> --}}
        </div>
    </div>

    <div class="relative text-center max-w-lg mx-auto">
        <!-- Logo -->
        <div class="fade-in">
            <div class="logo-container inline-flex items-center justify-center w-24 h-24 md:w-1/3 md:h-1/3 rounded-lg">
                <img src="{{ asset('assets/images/logo-ua.png') }}" alt="logo">
            </div>
        </div>

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
            /* indigo-600 */
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
    </style>
@endpush
