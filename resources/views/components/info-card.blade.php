<div class="lg:col-span-8 bg-white border border-slate-200/80 rounded-2xl p-6 sm:p-8 shadow-sm dark:bg-slate-800/50 dark:border-slate-700">
    <div
        class="border-b border-slate-100 pb-5 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-2 dark:border-slate-700">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $profile['name'] }}</h2>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $profile['role'] }}</p>
        </div>
    </div>

    <!-- Key-Value Display Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-id-card text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">NRP</dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['nrp'] }}</dd>
            </div>
        </div>

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-graduation-cap text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Major & Degree
                </dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['major'] }}</dd>
            </div>
        </div>

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-envelope text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Institutional
                    Email</dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['email'] }}</dd>
            </div>
        </div>

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-chart-line text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Current
                    Academic Standing</dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['standing'] }}</dd>
            </div>
        </div>

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-user-tie text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Academic
                    Advisor</dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['advisor'] }}</dd>
            </div>
        </div>

        <div class="flex items-start space-x-3">
            <div
                class="w-10 h-10 rounded-lg bg-blue-50 text-its-accent flex items-center justify-center shrink-0 dark:bg-slate-800 dark:text-blue-400">
                <i class="fa-solid fa-lightbulb text-base"></i>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Focus &
                    Research Interest</dt>
                <dd class="text-sm font-semibold text-slate-800 mt-0.5 dark:text-slate-200">{{ $profile['focus'] }}</dd>
            </div>
        </div>

    </div>
</div>
