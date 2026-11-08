@extends('layouts.app')

@section('content')
    @if(isset($welcomeUser))
        <x-status-banner title="Selamat Datang!">
            Selamat datang, {{ $welcomeUser }}!
        </x-status-banner>
    @endif

    @if(session('success_data'))
        @php $data = session('success_data'); @endphp
        <x-status-banner title="Success!">
            Name: {{ $data['name'] }}, NRP: {{ $data['nrp'] }}, Idea: {{ $data['idea'] }}
        </x-status-banner>
    @endif

    <section
        class="relative bg-gradient-to-b from-blue-50/50 via-white to-slate-50 py-16 lg:py-24 overflow-hidden dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- Left Text Column -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">

                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight dark:text-white">
                        Shaping the Future of <span class="text-its-accent">Computer Science</span>
                    </h1>

                    <p class="text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed dark:text-slate-300">
                        Welcome to the Department of Informatics at ITS. We pioneer research, foster world-class tech
                        leaders, and build innovative solutions for global impact.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#majors"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-its-accent hover:bg-its-blue text-white font-semibold text-center shadow-lg shadow-blue-500/25 transition duration-200">
                            Explore Majors
                        </a>
                        <a href="#labs"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-white border border-slate-200 hover:border-slate-300 text-slate-700 font-semibold text-center shadow-sm hover:shadow transition duration-200 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:border-slate-600">
                            Our Laboratories
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-200/80 dark:border-slate-800">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent">1985</div>
                            <div class="text-xs sm:text-sm text-slate-500 font-medium dark:text-slate-400">Established</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent">50+</div>
                            <div class="text-xs sm:text-sm text-slate-500 font-medium dark:text-slate-400">Lecturers</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent">5+</div>
                            <div class="text-xs sm:text-sm text-slate-500 font-medium dark:text-slate-400">Study Programs
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Image Column -->
                <div class="lg:col-span-6 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Decorative Accent backdrop -->
                        <div
                            class="absolute -top-4 -bottom-4 -left-4 -right-4 bg-gradient-to-tr from-blue-200 to-indigo-100 rounded-3xl transform -rotate-1 -z-10 dark:from-blue-900/30 dark:to-indigo-950/30">
                        </div>

                        <!-- Main Hero Image Box -->
                        <div
                            class="relative aspect-[16/10] sm:aspect-[4/3] rounded-2xl bg-slate-200 border-4 border-white shadow-2xl overflow-hidden flex flex-col items-center justify-center text-slate-400 group dark:bg-slate-800 dark:border-slate-700">
                            <!-- Background Grid Effect -->
                            <div
                                class="absolute inset-0 bg-[linear-gradient(to_right,#00000008_1px,transparent_1px),linear-gradient(to_bottom,#00000008_1px,transparent_1px)] bg-[size:16px_16px] dark:bg-[linear-gradient(to_right,#ffffff08_1px,transparent_1px),linear-gradient(to_bottom,#ffffff08_1px,transparent_1px)]">
                            </div>

                            <img src="/images/department.jpg" alt="Informatics Engineering Department"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Available Majors Section -->
    <section id="majors" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-its-accent">Undergraduate Academic Programs
                </h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Available Majors</h3>
                <p class="text-slate-600 dark:text-slate-400">Explore our undergraduate study programs designed to equip
                    future tech
                    pioneers with theoretical depth and industrial mastery.</p>
            </div>

            <!-- Majors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @php
                    $majors = [
                        [
                            'code' => 'IF',
                            'title' => 'Informatics Engineering',
                            'native' => 'Teknik Informatika',
                            'icon' => 'fa-laptop-code',
                            'desc' =>
                                'Focuses on theoretical computer science, algorithms, database systems, cybersecurity, and intelligent systems engineering.',
                            'url' => 'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-s1/',
                        ],
                        [
                            'code' => 'RPL',
                            'title' => 'Software Engineering',
                            'native' => 'Rekayasa Perangkat Lunak',
                            'icon' => 'fa-cubes text-3xl',
                            'desc' =>
                                'Dedicated to modern enterprise software construction, microservices architecture, DevOps, agile methodologies, and quality assurance.',
                            'url' =>
                                'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-sarjana-s1-rekayasa-perangkat-lunak/',
                        ],
                        [
                            'code' => 'RKA',
                            'title' => 'AI Engineering',
                            'native' => 'Rekayasa Kecerdasan Artifisial',
                            'icon' => 'fa-brain text-3xl',
                            'desc' =>
                                'Specializes in machine learning, deep learning, computer vision, natural language processing, and scalable AI infrastructure.',
                            'url' =>
                                'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-sarjana-s1-rekayasa-kecerdasan-artifisial/',
                        ],
                    ];
                @endphp

                @foreach ($majors as $major)
                    <div
                        class="bg-slate-50 border border-slate-200/80 rounded-2xl p-8 hover:shadow-xl transition duration-300 flex flex-col justify-between group relative overflow-hidden dark:bg-slate-800/50 dark:border-slate-700 dark:hover:border-blue-500">
                        <!-- Background Accent Card Line -->
                        <div
                            class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-its-accent to-its-blue group-hover:h-2 transition-all">
                        </div>

                        <div>
                            <!-- Header with Badge & Icon -->
                            <div class="flex items-center justify-between mb-6">
                                <div
                                    class="w-14 h-14 rounded-xl bg-blue-100/80 text-its-accent flex items-center justify-center text-2xl group-hover:scale-110 transition duration-300 dark:bg-slate-800 dark:text-blue-400">
                                    <i class="fa-solid {{ $major['icon'] }}"></i>
                                </div>
                                <span
                                    class="text-sm font-extrabold px-3.5 py-1.5 rounded-full bg-its-blue text-white shadow-sm">
                                    {{ $major['code'] }}
                                </span>
                            </div>

                            <h4
                                class="text-2xl font-bold text-slate-900 group-hover:text-its-accent transition mb-1 dark:text-white">
                                {{ $major['title'] }}
                            </h4>
                            <p class="text-xs font-semibold text-slate-400 mb-4 dark:text-slate-500">{{ $major['native'] }}
                            </p>

                            <p class="text-sm text-slate-600 leading-relaxed mb-6 dark:text-slate-300">
                                {{ $major['desc'] }}
                            </p>
                        </div>

                        <div
                            class="pt-6 border-t border-slate-200/80 flex items-center justify-between dark:border-slate-700">
                            <a href="{{ $major['url'] }}"
                                class="inline-flex items-center text-xs font-bold text-its-accent hover:text-its-blue transition group-hover:translate-x-1">
                                Visit <i class="fa-solid fa-arrow-right ml-1.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Research Laboratories Section -->
    <section id="labs"
        class="py-20 bg-slate-100/70 overflow-hidden border-y border-slate-200/60 dark:bg-slate-950 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-its-accent">Research & Innovation
                    Laboratories</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Informatics Laboratories</h3>
                <p class="text-slate-600 dark:text-slate-400">Explore our 8 dedicated laboratories driving cutting-edge
                    research, industry
                    collaborations, and hands-on learning.</p>
            </div>
        </div>

        @php
            $labs = [
                [
                    'name' => 'Algoritma dan Pemrograman (ALPRO)',
                    'icon' => 'fa-code',
                    'url' =>
                        'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-algoritma-dan-pemrograman/',
                    'image_url' => '/images/labs/alpro.png',
                ],
                [
                    'name' => 'Rekayasa Perangkat Lunak (RPL)',
                    'icon' => 'fa-diagram-project',
                    'url' =>
                        'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-rekayasa-perangkat-lunak/',
                    'image_url' => '/images/labs/rpl.png',
                ],
                [
                    'name' => 'Net-Centric Computing (NCC)',
                    'icon' => 'fa-network-wired',
                    'url' => 'https://www.its.ac.id/informatika/en/net-centric-computing-laboratory/',
                    'image_url' => '/images/labs/ncc.jpg',
                ],
                [
                    'name' => 'Komputasi Cerdas Visi (KCV)',
                    'icon' => 'fa-eye',
                    'url' =>
                        'https://www.its.ac.id/informatika/en/laboratory/information-intelligent-management-laboratory/',
                    'image_url' => '/images/labs/kcv.jpeg',
                ],
                [
                    'name' => 'Arsitektur dan Jaringan Komputer (Netics)',
                    'icon' => 'fa-server',
                    'url' =>
                        'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-arsitektur-dan-jaringan-komputer/',
                    'image_url' => '/images/labs/netics.png',
                ],
                [
                    'name' => 'Pemodelan dan Komputasi Terapan (PKT)',
                    'icon' => 'fa-chart-pie',
                    'url' =>
                        'https://www.its.ac.id/informatika/en/laboratory/applied-modelling-and-computation-laboratory/',
                    'image_url' => '/images/labs/pkt.jpg',
                ],
                [
                    'name' => 'Manajemen Cerdas Informasi (MCI)',
                    'icon' => 'fa-database',
                    'url' =>
                        'https://www.its.ac.id/informatika/en/laboratory/information-intelligent-management-laboratory/',
                    'image_url' => '/images/labs/mci.jpeg',
                ],
                [
                    'name' => 'Grafika, Interaksi, Gim, dan Analitik (GIGA)',
                    'icon' => 'fa-vr-cardboard',
                    'url' =>
                        'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-grafika-interaksi-dan-game/',
                    'image_url' => '/images/labs/giga.png',
                ],
            ];
        @endphp

        <!-- Draggable Marquee Wrapper -->
        <div class="relative w-full overflow-hidden py-4 select-none">
            <!-- Left and Right Gradient Overlay Fades -->
            <div
                class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-slate-100/90 to-transparent z-10 pointer-events-none dark:from-slate-950/90">
            </div>
            <div
                class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-slate-100/90 to-transparent z-10 pointer-events-none dark:from-transparent dark:to-slate-950/90">
            </div>

            <!-- Scrollable & Draggable Outer Container -->
            <div id="marqueeContainer" class="overflow-x-auto no-scrollbar cursor-grab active:cursor-grabbing flex">
                <div id="marqueeTrack" class="flex space-x-6 w-max">
                    @foreach (array_merge($labs, $labs, $labs) as $lab)
                        <a href="{{ $lab['url'] }}" draggable="false"
                            class="lab-card w-72 h-56 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:border-its-accent transition-all duration-300 flex flex-col items-center justify-center text-center space-y-3 shrink-0 group dark:bg-slate-800/50 dark:border-slate-700 dark:hover:border-blue-500">
                            <!-- Lab Logo Placeholder -->
                            <div
                                class="w-14 h-14 rounded-xl bg-white text-its-blue flex items-center justify-center text-2xl border border-blue-100 shadow-inner group-hover:scale-110 group-hover:text-white transition duration-300 dark:bg-slate-800 dark:border-slate-700">
                                <img src="{{ $lab['image_url'] }}" alt="{{ $lab['name'] }} Logo"
                                    class="w-full h-full object-cover rounded-xl">
                            </div>
                            <!-- Lab Name -->
                            <h5
                                class="text-sm font-bold text-slate-800 group-hover:text-its-accent transition line-clamp-2 px-2 dark:text-slate-200">
                                {{ $lab['name'] }}
                            </h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Marquee Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('marqueeContainer');
            const track = document.getElementById('marqueeTrack');

            let speed = 1.5;
            let isHovered = false;
            let isDragging = false;
            let startX = 0;
            let scrollLeftPos = 0;
            let dragDistance = 0;

            container.scrollLeft = track.scrollWidth / 3;

            function tick() {
                if (!isHovered && !isDragging) {
                    container.scrollLeft += speed;
                }

                const oneSetWidth = track.scrollWidth / 3;
                if (container.scrollLeft >= oneSetWidth * 2) {
                    container.scrollLeft -= oneSetWidth;
                } else if (container.scrollLeft <= 0) {
                    container.scrollLeft += oneSetWidth;
                }

                requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);

            container.addEventListener('mouseenter', () => isHovered = true);
            container.addEventListener('mouseleave', () => {
                isHovered = false;
                isDragging = false;
            });

            container.addEventListener('mousedown', (e) => {
                isDragging = true;
                dragDistance = 0;
                startX = e.pageX - container.offsetLeft;
                scrollLeftPos = container.scrollLeft;
            });

            container.addEventListener('mouseup', () => {
                isDragging = false;
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 1.5;
                dragDistance = Math.abs(walk);
                container.scrollLeft = scrollLeftPos - walk;
            });

            const labCards = document.querySelectorAll('.lab-card');
            labCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (dragDistance > 8) {
                        e.preventDefault();
                    }
                });
            });

            let touchStartX = 0;
            container.addEventListener('touchstart', (e) => {
                isHovered = true;
                touchStartX = e.touches[0].pageX;
                scrollLeftPos = container.scrollLeft;
            }, {
                passive: true
            });

            container.addEventListener('touchmove', (e) => {
                const touchX = e.touches[0].pageX;
                const walk = (touchX - touchStartX) * 1.5;
                container.scrollLeft = scrollLeftPos - walk;
            }, {
                passive: true
            });

            container.addEventListener('touchend', () => {
                isHovered = false;
            });
        });
    </script>
@endsection
