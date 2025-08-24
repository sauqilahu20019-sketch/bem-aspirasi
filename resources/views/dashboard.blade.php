<x-layouts.app :title="__('Dashboard')">
    @push('style')
        <style>
            .stat-slider {
                scrollbar-width: none;
                /* Firefox */
            }

            .stat-slider::-webkit-scrollbar {
                display: none;
                /* Chrome, Safari, Edge */
            }

            .progress-bar {
                transition: width 1s ease-in-out;
            }

            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        </style>
    @endpush

    <div class="min-h-screen flex flex-col">

        <!-- Main Content -->
        <div class="flex flex-1 pt-5">
            <!-- Content Area -->
            <main class="flex-1">
                <!-- Welcome Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang, <span
                            class="text-primary">{{ Auth::user()->full_name }}</span>!</h2>
                    <p class="text-gray-600">Berikut adalah ringkasan aktivitas sistem aspirasi kampus.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Mahasiswa Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <img src="{{ asset('assets/images/mhs.png') }}" alt="mhs" width="40">
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Mahasiswa</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalMhs }}</h3>
                        </div>
                    </div>

                    <!-- Warek Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <img src="{{ asset('assets/images/rektor.png') }}" alt="mhs" width="40">
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Warek</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalWrk }}</h3>
                        </div>
                    </div>

                    <!-- Rektor Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <img src="{{ asset('assets/images/rector.png') }}" alt="rek" width="40">
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Rektor</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalRek }}</h3>
                        </div>
                    </div>

                    <!-- Admin Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                        <div class="bg-red-100 p-3 rounded-full mr-4">
                            <img src="{{ asset('assets/images/admin.png') }}" alt="adm" width="40">
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Admin</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalAdm }}</h3>
                        </div>
                    </div>
                </div>

                <div class="flex gap-5">
                    <!-- Aspirasi Section with Custom Slider -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Statistik Aspirasi</h3>
                            <a href="#" class="text-sm text-blue-400 hover:text-blue-600">Lihat Semua</a>
                        </div>

                        <!-- Custom Slider Container -->
                        <div class="relative">
                            <!-- Slider Navigation -->
                            <div class="flex justify-between items-center mb-4">
                                <button id="prevBtn" class="bg-gray-200 hover:bg-gray-300 rounded-full p-2">
                                    <img src="{{ asset('assets/images/left-arrow.png') }}" alt="" width="20">
                                </button>
                                <div class="flex space-x-2">
                                    <button class="slider-dot w-2 h-2 rounded-full bg-gray-400" data-index="0"></button>
                                    <button class="slider-dot w-2 h-2 rounded-full bg-gray-400" data-index="1"></button>
                                    <button class="slider-dot w-2 h-2 rounded-full bg-gray-400" data-index="2"></button>
                                    <button class="slider-dot w-2 h-2 rounded-full bg-gray-400" data-index="3"></button>
                                </div>
                                <button id="nextBtn" class="bg-gray-200 hover:bg-gray-300 rounded-full p-2">
                                    <img src="{{ asset('assets/images/right-arrow.png') }}" alt="" width="20">
                                </button>
                            </div>

                            <!-- Slider for Stats -->
                            <div class="overflow-hidden">
                                <div id="sliderContainer"
                                    class="stat-slider flex transition-transform duration-300 ease-in-out">
                                    <!-- Slide 1: Total Aspirasi -->
                                    <div class="w-full flex-shrink-0 px-2">
                                        <div class="stat-card bg-white border border-gray-200 rounded-xl p-6 fade-in">
                                            <div class="flex justify-between items-center mb-4">
                                                <div class="flex items-center">
                                                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                                                        <i class="fas fa-paper-plane text-primary text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-sm">Total Aspirasi</p>
                                                        <h3 class="text-2xl font-bold text-gray-800">{{ $aspTot }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-3 mt-4">
                                                <div class="bg-primary h-3 rounded-full progress-bar"
                                                    style="width: 100%">
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2">Semua aspirasi yang telah dikirim</p>
                                        </div>
                                    </div>

                                    <!-- Slide 2: Aspirasi Dalam Proses -->
                                    <div class="w-full flex-shrink-0 px-2">
                                        <div class="stat-card bg-white border border-gray-200 rounded-xl p-6 fade-in">
                                            <div class="flex justify-between items-center mb-4">
                                                <div class="flex items-center">
                                                    <div class="bg-yellow-100 p-3 rounded-full mr-3">
                                                        <i class="fas fa-spinner text-warning text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-sm">Dalam Proses</p>
                                                        <h3 class="text-2xl font-bold text-gray-800">{{ $aspPen }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-3 mt-4">
                                                <div class="bg-warning h-3 rounded-full progress-bar"
                                                    style="width: 52%">
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2">{{ $aspTot > 0? round(($aspPen / $aspTot) * 100) : 0 }}% dari total aspirasi</p>
                                        </div>
                                    </div>

                                    <!-- Slide 3: Aspirasi Selesai -->
                                    <div class="w-full flex-shrink-0 px-2">
                                        <div class="stat-card bg-white border border-gray-200 rounded-xl p-6 fade-in">
                                            <div class="flex justify-between items-center mb-4">
                                                <div class="flex items-center">
                                                    <div class="bg-green-100 p-3 rounded-full mr-3">
                                                        <i class="fas fa-check-circle text-success text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-sm">Selesai</p>
                                                        <h3 class="text-2xl font-bold text-gray-800">{{ $aspAcc }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-3 mt-4">
                                                <div class="bg-success h-3 rounded-full progress-bar"
                                                    style="width: 36%">
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2">{{ $aspTot > 0? round(($aspAcc / $aspTot) * 100) : 0 }}% dari total aspirasi</p>
                                        </div>
                                    </div>

                                    <!-- Slide 4: Aspirasi Ditolak -->
                                    <div class="w-full flex-shrink-0 px-2">
                                        <div class="stat-card bg-white border border-gray-200 rounded-xl p-6 fade-in">
                                            <div class="flex justify-between items-center mb-4">
                                                <div class="flex items-center">
                                                    <div class="bg-red-100 p-3 rounded-full mr-3">
                                                        <i class="fas fa-times-circle text-danger text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-500 text-sm">Ditolak</p>
                                                        <h3 class="text-2xl font-bold text-gray-800">{{ $aspRej }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-3 mt-4">
                                                <div class="bg-danger h-3 rounded-full progress-bar"
                                                    style="width: 11%">
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2">{{ $aspTot > 0? round(($aspRej / $aspTot) * 100) : 0 }}% dari total aspirasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Aspirasi -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Aspirasi Terbaru</h3>
                            <a href="{{ route('list.aspirasi') }}" class="text-sm text-blue-400 hover:text-blue-600">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @foreach ($aspirasis as $aspirasi)
                                <div class="flex items-start border-b pb-3">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-comment text-primary"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold">{{ $aspirasi->aspirasi }}</h4>
                                        <p class="text-sm text-gray-600">Dari: {{ $aspirasi->pengaju->full_name }} - {{ $aspirasi->pengaju->prodi }}</p>
                                        <p class="text-xs text-gray-500">{{ $aspirasi->created_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="bg-warning text-white text-xs px-2 py-1 rounded-full">Proses</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Slider functionality
                const sliderContainer = document.getElementById('sliderContainer');
                const slides = document.querySelectorAll('.stat-card');
                const dots = document.querySelectorAll('.slider-dot');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                let currentSlide = 0;
                const slideCount = slides.length;

                // Update slider position
                function updateSlider() {
                    sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

                    // Update dots
                    dots.forEach((dot, index) => {
                        if (index === currentSlide) {
                            dot.classList.add('bg-gray-600');
                            dot.classList.remove('bg-gray-400');
                        } else {
                            dot.classList.remove('bg-gray-600');
                            dot.classList.add('bg-gray-400');
                        }
                    });

                    // Animate progress bars
                    document.querySelectorAll('.progress-bar').forEach(bar => {
                        const width = bar.style.width;
                        bar.style.width = '0';
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 100);
                    });
                }

                // Next slide
                nextBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slideCount;
                    updateSlider();
                });

                // Previous slide
                prevBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                    updateSlider();
                });

                // Dot navigation
                dots.forEach(dot => {
                    dot.addEventListener('click', () => {
                        currentSlide = parseInt(dot.getAttribute('data-index'));
                        updateSlider();
                    });
                });

                // Auto slide every 5 seconds
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slideCount;
                    updateSlider();
                }, 5000);

                // Initialize slider
                updateSlider();
            });
        </script>
    @endpush
</x-layouts.app>
