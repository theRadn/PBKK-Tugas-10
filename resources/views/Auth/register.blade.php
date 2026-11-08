@extends('layouts.app')

@section('content') 
    <section class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50/50 via-white to-indigo-50/40 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <div class="w-full max-w-md">
            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0055B8]/10 text-[#0055B8] dark:bg-blue-500/20 dark:text-blue-400 mb-4 shadow-sm">
                    <i class="fa-solid fa-user-plus text-2xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Buat Akun Baru</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Daftar untuk menguji pembuatan akun dan melihat dashboard project kamu</p>
            </div>

            {{-- Error Messages Box --}}
            <div id="register-errors" class="{{ $errors->any() ? '' : 'hidden' }} mb-5 p-4 bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 rounded-2xl text-sm text-red-600 dark:text-red-400">
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
                <form id="register-form" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#0055B8] focus:border-transparent transition"
                                placeholder="Budi Santoso">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#0055B8] focus:border-transparent transition"
                                placeholder="budi@example.com">
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
                                placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-shield-halved text-sm"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#0055B8] focus:border-transparent transition"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <button type="submit" id="register-btn"
                        class="w-full py-3.5 px-4 bg-[#0055B8] hover:bg-[#003C80] active:scale-[0.99] text-white font-bold rounded-xl shadow-lg shadow-blue-600/25 transition duration-200 flex items-center justify-center gap-2 mt-2">
                        <span>Daftar Akun</span>
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Sudah punya akun?
                        <a href="{{ route('login.form') }}" class="text-[#0055B8] dark:text-blue-400 font-semibold hover:underline">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('register-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('register-btn');
            const errBox = document.getElementById('register-errors');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i><span>Mendaftarkan...</span>';
            errBox.classList.add('hidden');

            try {
                const res = await fetch('{{ route("register") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
                        password_confirmation: document.getElementById('password_confirmation').value,
                    }),
                });

                if (res.ok || res.status === 204) {
                    window.location.href = '{{ route("dashboard") }}';
                } else {
                    const data = await res.json();
                    let msg = data.message || 'Pendaftaran gagal.';
                    if (data.errors) {
                        const items = Object.values(data.errors).flat();
                        msg = items.join('<br>');
                    }
                    errBox.innerHTML = msg;
                    errBox.classList.remove('hidden');
                    btn.disabled = false;
                    btn.innerHTML = '<span>Daftar Akun</span><i class="fa-solid fa-arrow-right text-sm"></i>';
                }
            } catch (err) {
                e.target.submit();
            }
        });
    </script>
@endsection
