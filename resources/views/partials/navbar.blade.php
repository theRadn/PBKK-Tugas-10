<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 dark:bg-slate-950/90 dark:border-slate-800 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        <!-- Navigation Links --> 
        <nav class="mx-auto">
            <ul class="flex items-center space-x-8 text-sm font-semibold">
                <li>
                    <a href="{{ route('beranda') }}"
                        class="py-2 transition duration-200 {{ request()->routeIs('beranda') ? 'text-[#0055B8] border-b-2 border-[#0055B8] font-bold dark:text-blue-400 dark:border-blue-400' : 'text-slate-600 hover:text-blue-400 dark:text-slate-400 dark:hover:text-blue-400' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.detail') }}"
                        class="py-2 transition duration-200 {{ request()->routeIs('mahasiswa.detail') ? 'text-[#0055B8] border-b-2 border-[#0055B8] font-bold dark:text-blue-400 dark:border-blue-400' : 'text-slate-600 hover:text-blue-400 dark:text-slate-400 dark:hover:text-blue-400' }}">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.idea') }}"
                        class="py-2 transition duration-200 {{ request()->routeIs('agent.idea') ? 'text-[#0055B8] border-b-2 border-[#0055B8] font-bold dark:text-blue-400 dark:border-blue-400' : 'text-slate-600 hover:text-blue-400 dark:text-slate-400 dark:hover:text-blue-400' }}">
                        Agent
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="py-2 transition duration-200 {{ request()->routeIs('dashboard') ? 'text-[#0055B8] border-b-2 border-[#0055B8] font-bold dark:text-blue-400 dark:border-blue-400' : 'text-slate-600 hover:text-blue-400 dark:text-slate-400 dark:hover:text-blue-400' }}">
                        Dashboard
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Right Side Actions -->
        <div class="flex items-center gap-3">
            @auth
                <div class="hidden sm:flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                    <i class="fa-solid fa-user-circle text-its-accent text-sm"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="p-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-950/50 dark:text-red-400 dark:hover:bg-red-900/50 transition flex items-center justify-center w-10 h-10 shadow-sm"
                        title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-sm"></i>
                    </button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login.form') }}"
                    class="text-sm font-semibold text-slate-600 hover:text-its-accent dark:text-slate-400 dark:hover:text-blue-400 px-3 py-2 transition duration-200">
                    Login
                </a>
                <a href="{{ route('register.form') }}"
                    class="text-sm font-semibold px-4 py-2 rounded-xl bg-its-accent hover:bg-its-blue text-white shadow-md shadow-blue-500/20 transition duration-200">
                    Register
                </a>
            @endguest
            <button onclick="toggleTheme()"
                class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 transition flex items-center justify-center w-10 h-10 shadow-sm"
                title="Toggle Dark/Light Mode">
                <!-- Moon icon shows in Light mode -->
                <i class="fa-solid fa-moon dark:hidden text-sm"></i>
                <!-- Sun icon shows in Dark mode -->
                <i class="fa-solid fa-sun hidden dark:block text-amber-400 text-sm"></i>
            </button>
        </div>

    </div>
</header>

<script>
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }
</script>
