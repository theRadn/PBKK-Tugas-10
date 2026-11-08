@extends('layouts.app')

@section('content')
    <section class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50/50 via-white to-indigo-50/40 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <div class="w-full max-w-md">
            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0055B8]/10 text-[#0055B8] dark:bg-blue-500/20 dark:text-blue-400 mb-4 shadow-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket text-2xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Masuk ke Akun</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Login untuk mengakses dan mengelola Dashboard Project kamu</p>
            </div>

            {{-- Demo Account Quick Action --}}
            <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-800/80 border border-blue-100 dark:border-slate-700 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#0055B8] dark:text-blue-400">
                            <i class="fa-solid fa-sparkles"></i> Akun Demo Tersedia
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">
                            Gunakan akun demo terisi project: <strong class="text-slate-800 dark:text-white">dosenpbkk@its.ac.id</strong>
                        </p>
                    </div>
                    <button type="button" onclick="fillDemo()"
                        class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-[#0055B8] text-white hover:bg-blue-700 transition shadow-sm whitespace-nowrap">
                        Gunakan Demo
                    </button>
                </div>
            </div>

            {{-- Error Messages Box --}}
            <div id="login-errors" class="{{ $errors->any() ? '' : 'hidden' }} mb-5 p-4 bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 rounded-2xl text-sm text-red-600 dark:text-red-400">
                @if ($errors->any())
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Form Card --}}
            <div class="bg-white dark:bg-slate-900/90 backdrop-blur-xl p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#0055B8] focus:border-transparent transition"
                                placeholder="dosenpbkk@its.ac.id">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#0055B8] focus:border-transparent transition"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" id="login-btn"
                        class="w-full py-3.5 px-4 bg-[#0055B8] hover:bg-[#003C80] active:scale-[0.99] text-white font-bold rounded-xl shadow-lg shadow-blue-600/25 transition duration-200 flex items-center justify-center gap-2">
                        <span>Login</span>
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Belum punya akun?
                        <a href="{{ route('register.form') }}" class="text-[#0055B8] dark:text-blue-400 font-semibold hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function fillDemo() {
            document.getElementById('email').value = 'dosenpbkk@its.ac.id';
            document.getElementById('password').value = 'password';
        }

        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('login-btn');
            const errBox = document.getElementById('login-errors');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i><span>Logging in...</span>';
            errBox.classList.add('hidden');

            try {
                const res = await fetch('{{ route("login") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                    }),
                });

                if (res.ok || res.status === 204) {
                    window.location.href = '{{ route("dashboard") }}';
                } else {
                    const data = await res.json();
                    let msg = data.message || 'Email atau password salah.';
                    if (data.errors) {
                        const items = Object.values(data.errors).flat();
                        msg = items.join('<br>');
                    }
                    errBox.innerHTML = msg;
                    errBox.classList.remove('hidden');
                    btn.disabled = false;
                    btn.innerHTML = '<span>Login</span><i class="fa-solid fa-arrow-right text-sm"></i>';
                }
            } catch (err) {
                // Fallback to regular form submission if fetch network error occurs
                e.target.submit();
            }
        });
    </script>
@endsection
