@extends('layouts.app')

@section('content')
    {{-- Dashboard Hero Header --}}
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50/50 py-12 lg:py-16 overflow-hidden dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 dark:bg-blue-900/10"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-200/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3 dark:bg-indigo-900/10"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                {{-- Welcome Text --}}
                <div class="space-y-2">
                    <p class="text-sm font-bold uppercase tracking-widest text-its-accent">Dashboard</p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                        Selamat datang, <span class="text-its-accent">{{ $user->name }}</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400">
                        Kelola dan pantau semua project kamu di satu tempat.
                    </p>
                </div>

                {{-- Stats Badge & Add Button --}}
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-slate-700 text-its-accent dark:text-blue-400 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $projects->total() }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                {{ request('search') ? 'Hasil Pencarian' : 'Total Project' }}
                            </p>
                        </div>
                    </div>

                    {{-- Add FP Project Button --}}
                    <button type="button" id="openModalBtn" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3.5 rounded-2xl shadow-lg hover:shadow-blue-500/25 transition-all duration-300 text-sm">
                        <i class="fa-solid fa-plus"></i>
                        <span>Tambah FP Project</span>
                    </button>

                    {{-- Create Modal --}}
                    <div id="projectModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl space-y-6 relative">

                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-slate-800 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                                        <i class="fa-solid fa-lightbulb"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Simpan Ide FP Project</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Masukkan detail project agent baru Anda</p>
                                    </div>
                                </div>
                                <button type="button" id="closeModalBtn" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-2">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            <form action="{{ route('agent.idea.store') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Judul Project</label>
                                    <input type="text" name="judul" required placeholder="Contoh: Smart Campus Assistant Agent"
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Tema Agent</label>
                                    <input type="text" name="tema_agent" required placeholder="Contoh: Generative AI / Automation"
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Deskripsi Project</label>
                                    <textarea name="deskripsi" rows="3" required placeholder="Jelaskan fungsionalitas dan tujuan project..."
                                              class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition"></textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">API Key Secure (Opsional)</label>
                                    <input type="password" name="api_key_secure" placeholder="Masukkan API Key jika diperlukan"
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition">
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                                    <button type="button" id="cancelModalBtn" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-md transition">
                                        Simpan Project
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Edit Modal --}}
                    <div id="editProjectModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6">
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl space-y-6 relative">

                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-slate-800 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Edit FP Project</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Perbarui detail project agent</p>
                                    </div>
                                </div>
                                <button type="button" id="closeEditModalBtn" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-2">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            <form id="editProjectForm" method="POST" action="" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Judul Project</label>
                                    <input type="text" name="judul" id="edit_judul" required
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 transition">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Tema Agent</label>
                                    <input type="text" name="tema_agent" id="edit_tema_agent" required
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 transition">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Deskripsi Project</label>
                                    <textarea name="deskripsi" id="edit_deskripsi" rows="3" required
                                              class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 transition"></textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">API Key Secure (Kosongkan jika tidak diubah)</label>
                                    <input type="password" name="api_key_secure" id="edit_api_key_secure" placeholder="••••••••"
                                           class="w-full rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 transition">
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                                    <button type="button" id="cancelEditModalBtn" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold shadow-md transition">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Flash Notifications --}}
            @if(session('success_data'))
                <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/90 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400 text-lg"></i>
                    <span>{{ session('success_data') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/90 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-sm space-y-1 shadow-sm">
                    <div class="flex items-center gap-2 font-semibold">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 dark:text-rose-400"></i>
                        <span>Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    {{-- Projects Grid Section --}}
    <section class="py-12 lg:py-16 bg-slate-50/50 dark:bg-slate-950 min-h-[50vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search Bar (always visible so the user can clear/modify it) --}}
            <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
                <div class="relative max-w-xl">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari judul project, tema agent, atau nama pemilik..."
                           class="w-full pl-11 pr-32 py-3 bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
                    @if(request('search'))
                        <a href="{{ route('dashboard') }}"
                           class="absolute inset-y-0 right-24 flex items-center pr-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition"
                           title="Reset pencarian">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                    <button type="submit"
                            class="absolute inset-y-1.5 right-1.5 px-5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm transition">
                        Cari
                    </button>
                </div>
            </form>

            @if($projects->isEmpty())
                @if(request('search'))
                    {{-- No search results --}}
                    <div class="max-w-lg mx-auto text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 flex items-center justify-center shadow-inner">
                            <i class="fa-solid fa-magnifying-glass text-4xl text-slate-400 dark:text-slate-500"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-3">
                            Tidak ada hasil untuk "{{ request('search') }}"
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-8">
                            Coba gunakan kata kunci lain, atau cek ejaan pencarian Anda.
                        </p>
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-3 rounded-2xl shadow-lg transition text-sm">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Reset Pencarian</span>
                        </a>
                    </div>
                @else
                    {{-- No projects at all --}}
                    <div class="max-w-lg mx-auto text-center py-20">
                        <div class="w-24 h-24 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-slate-800 dark:to-slate-700 flex items-center justify-center shadow-inner">
                            <i class="fa-solid fa-box-open text-4xl text-its-accent/60 dark:text-blue-400/60"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-3">
                            Belum ada project
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-8">
                            Kamu belum memiliki project. Mulai buat project pertamamu untuk melihatnya di sini.
                        </p>
                    </div>
                @endif
            @else
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                        @if(request('search'))
                            Hasil pencarian: <span class="text-its-accent">"{{ request('search') }}"</span>
                        @else
                            Project Kamu
                        @endif
                    </h2>
                    <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        {{ $projects->total() }} project · Diurutkan terbaru
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="group relative bg-white dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-its-accent dark:hover:border-blue-500 transition-all duration-300 flex flex-col overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-its-accent to-its-blue group-hover:h-1.5 transition-all"></div>

                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-100/80 dark:bg-slate-700 text-its-accent dark:text-blue-400 flex items-center justify-center text-lg group-hover:scale-110 transition duration-300">
                                    <i class="fa-solid fa-cube"></i>
                                </div>
                                <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-blue-600 text-white shadow-sm shrink-0">
                                    {{ $project->tema_agent }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-its-accent transition mb-2 line-clamp-2">
                                {{ $project->judul }}
                            </h3>

                            @if($project->deskripsi)
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-3 mb-4 flex-grow">
                                    {{ $project->deskripsi }}
                                </p>
                            @else
                                <p class="text-sm text-slate-400 dark:text-slate-500 italic mb-4 flex-grow">
                                    Belum ada deskripsi.
                                </p>
                            @endif

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500">
                                    <i class="fa-regular fa-clock"></i>
                                    <time datetime="{{ $project->created_at->toIso8601String() }}">
                                        {{ $project->created_at->diffForHumans() }}
                                    </time>
                                </div>

                                <div class="flex items-center gap-3">
                                    {{-- Admin-only actions: Edit + Delete --}}
                                    @can('delete-data')
                                        <button type="button"
                                                class="edit-project-btn text-xs font-semibold text-amber-500 hover:text-amber-600 dark:text-amber-400 dark:hover:text-amber-300 flex items-center gap-1 transition"
                                                title="Edit Project"
                                                data-update-url="{{ route('projects.update', $project) }}"
                                                data-project-judul="{{ $project->judul }}"
                                                data-project-tema="{{ $project->tema_agent }}"
                                                data-project-deskripsi="{{ $project->deskripsi }}">
                                            <i class="fa-solid fa-pen text-[11px]"></i>
                                            <span>Edit</span>
                                        </button>

                                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-xs font-semibold text-rose-500 hover:text-rose-600 dark:text-rose-400 dark:hover:text-rose-300 flex items-center gap-1 transition"
                                                    title="Hapus Project">
                                                <i class="fa-solid fa-trash text-[11px]"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endcan

                                    <div class="flex items-center gap-1 text-xs font-semibold text-its-accent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span>Detail</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination (preserves ?search= via withQueryString()) --}}
                <div class="mt-10">
                    {{ $projects->links() }}
                </div>
            @endif

        </div>
    </section>

    {{-- Vanilla JS for Modals --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /* ---------- Create Modal ---------- */
            const openBtn   = document.getElementById('openModalBtn');
            const closeBtn  = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelModalBtn');
            const modal     = document.getElementById('projectModal');

            function toggleModal(show) {
                modal.classList.toggle('hidden', !show);
            }

            if (openBtn)   openBtn.addEventListener('click',   () => toggleModal(true));
            if (closeBtn)  closeBtn.addEventListener('click',  () => toggleModal(false));
            if (cancelBtn) cancelBtn.addEventListener('click', () => toggleModal(false));
            if (modal) modal.addEventListener('click', e => { if (e.target === modal) toggleModal(false); });

            /* ---------- Edit Modal ---------- */
            const editModal     = document.getElementById('editProjectModal');
            const editForm      = document.getElementById('editProjectForm');
            const editCloseBtn  = document.getElementById('closeEditModalBtn');
            const editCancelBtn = document.getElementById('cancelEditModalBtn');

            function closeEditModal() {
                if (editModal) editModal.classList.add('hidden');
            }

            document.querySelectorAll('.edit-project-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    editForm.action = this.dataset.updateUrl;
                    document.getElementById('edit_judul').value          = this.dataset.projectJudul;
                    document.getElementById('edit_tema_agent').value     = this.dataset.projectTema;
                    document.getElementById('edit_deskripsi').value      = this.dataset.projectDeskripsi || '';
                    document.getElementById('edit_api_key_secure').value = '';
                    editModal.classList.remove('hidden');
                });
            });

            if (editCloseBtn)  editCloseBtn.addEventListener('click',  closeEditModal);
            if (editCancelBtn) editCancelBtn.addEventListener('click', closeEditModal);
            if (editModal) editModal.addEventListener('click', e => { if (e.target === editModal) closeEditModal(); });

            /* ---------- Keyboard shortcut: "/" focuses search ---------- */
            document.addEventListener('keydown', function (e) {
                if (e.key === '/' && !/^(INPUT|TEXTAREA|SELECT)$/.test(document.activeElement.tagName)) {
                    e.preventDefault();
                    const input = document.querySelector('input[name="search"]');
                    if (input) input.focus();
                }
            });
        });
    </script>
@endsection
