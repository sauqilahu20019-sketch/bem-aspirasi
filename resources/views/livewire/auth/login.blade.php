<div class="min-h-screen flex flex-col md:flex-row bg-white dark:bg-gray-900">
    <!-- Container 1: Form Login -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-md space-y-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 font-medium" wire:navigate>
                <span class="flex h-8 w-8 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-7 fill-current text-black dark:text-white" />
                </span>
                <span class="text-sm text-gray-600 dark:text-gray-400">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Judul -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-1">Selamat Datang</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Masuk untuk mengakses dashboard Anda</p>
            </div>

            <!-- Form Login -->
            <form wire:submit.prevent='login' class="space-y-4">
                <div>
                    <label for="nim"
                        class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">NIM</label>
                    <flux:input wire:model="nim" icon="user" type="text" required placeholder="Masukkan NIM" />
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <label for="password"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <a href="#"
                            class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Lupa
                            password?</a>
                    </div>
                    <flux:input wire:model="password" icon="key" viewable type="password" required placeholder="Masukkan password anda" />
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

            <div
                class="pt-4 text-center text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                Belum punya akun? <a href="{{ route('register') }}"
                    class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Daftar
                    sekarang</a>
            </div>
        </div>
    </div>

    <div
        class="w-full md:w-1/2 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/30 flex items-center justify-center relative overflow-hidden">

        <div class="relative text-center max-w-lg">
            <!-- Animated Welcome Text -->
            <h1 class="text-xl md:text-2xl font-bold text-indigo-800 dark:text-indigo-100 leading-snug">
                <span id="typing-title" class="relative inline-block">
                    <span
                        class="absolute top-0 w-0.5 h-6 bg-indigo-600 dark:bg-indigo-300 animate-pulse"></span>
                </span>
            </h1>

            <!-- Animated Subtitle -->
            <h3 class="text-sm md:text-base text-indigo-600 dark:text-indigo-300/90 font-medium">
                <span id="typing-subtitle" class="opacity-0"></span>
            </h3>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleText = "Welcome to BEM-KM Universitas Annuqayah";
            const subtitleText = "Sistem Informasi Pengajuan Aspirasi Mahasiswa";

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
