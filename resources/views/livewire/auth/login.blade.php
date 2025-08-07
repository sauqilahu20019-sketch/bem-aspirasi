
<div class="w-full bg-white flex">
    <!-- Container 1: Form Login -->
    <div class="w-full flex items-center justify-center p-12">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Judul -->
            <h1 class="text-3xl font-bold text-gray-900 mb-2 text-center">Selamat Datang</h1>
            <p class="text-gray-500 mb-8 text-center">Masuk untuk mengakses dashboard Anda</p>

            <!-- Form Login -->
            <form class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                        placeholder="email@contoh.com">
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                    </div>
                    <input type="password" id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                        placeholder="Masukkan password">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Daftar
                    sekarang</a>
            </div>
        </div>
    </div>

    <!-- Container 2: Ilustrasi SVG Animasi -->
    <div class="w-full bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center p-12">
        <div class="relative w-full h-full max-w-xl">
            <!-- SVG Illustration -->
            <svg class="w-full h-auto" viewBox="0 0 600 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circles -->
                <circle cx="450" cy="100" r="60" fill="#818CF8" fill-opacity="0.2"
                    class="animate-float-slow" />
                <circle cx="150" cy="400" r="80" fill="#A78BFA" fill-opacity="0.2"
                    class="animate-float-slower" />

                <!-- Main Illustration -->
                <g class="animate-float">
                    <path
                        d="M300 150C300 206.228 253.228 253 197 253C140.772 253 94 206.228 94 150C94 93.7715 140.772 47 197 47C253.228 47 300 93.7715 300 150Z"
                        fill="#6366F1" />
                    <path
                        d="M197 121C209.15 121 219 111.15 219 99C219 86.8497 209.15 77 197 77C184.85 77 175 86.8497 175 99C175 111.15 184.85 121 197 121Z"
                        fill="white" />
                    <path
                        d="M197 173C216.33 173 232 157.33 232 138C232 118.67 216.33 103 197 103C177.67 103 162 118.67 162 138C162 157.33 177.67 173 197 173Z"
                        fill="white" />
                </g>

                <!-- Lock Icon -->
                <g transform="translate(200, 250)" class="animate-bounce">
                    <rect x="50" y="80" width="100" height="120" rx="10" fill="#4F46E5" />
                    <rect x="70" y="30" width="60" height="50" rx="5" fill="#4F46E5" />
                    <circle cx="100" cy="140" r="20" fill="#A78BFA" />
                </g>

                <!-- Document Icon -->
                <g transform="translate(350, 300)" class="animate-pulse">
                    <path d="M80 40H140L160 60V160H80V40Z" fill="#8B5CF6" stroke="#6D28D9" stroke-width="2" />
                    <path d="M140 40V60H160" stroke="#6D28D9" stroke-width="2" fill="none" />
                    <line x1="90" y1="80" x2="150" y2="80" stroke="white" stroke-width="2" />
                    <line x1="90" y1="100" x2="150" y2="100" stroke="white" stroke-width="2" />
                    <line x1="90" y1="120" x2="130" y2="120" stroke="white" stroke-width="2" />
                </g>
            </svg>
        </div>
    </div>
</div>

@push('styles')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes float-slower {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(15px);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(0.98);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .animate-float-slower {
            animation: float-slower 10s ease-in-out infinite;
        }

        .animate-bounce {
            animation: bounce 4s ease-in-out infinite;
        }

        .animate-pulse {
            animation: pulse 3s ease-in-out infinite;
        }
    </style>
@endpush
