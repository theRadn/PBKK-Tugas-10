@props(['title' => 'Success!'])

@php
    $notificationId = 'notification-' . uniqid();
@endphp

<div id="{{ $notificationId }}"
     style="opacity: 1; transform: translateY(0);"
     class="bg-its-accent text-white px-6 py-4 rounded-2xl shadow-2xl transition-all duration-500 ease-in-out dark:bg-blue-600 fixed top-20 right-4 z-50 pointer-events-auto">
    <div class="flex items-start justify-between gap-4">
        <div>
            <strong class="font-bold text-base">{{ $title }}</strong>
            <div class="mt-1 text-sm text-blue-50">
                {{ $slot }}
            </div>
        </div>
        <button type="button" onclick="dismissNotification('{{ $notificationId }}')" class="text-white/70 hover:text-white font-bold text-lg leading-none cursor-pointer">&times;</button>
    </div>
</div>

<script>
    (function() {
        window.dismissNotification = function(id) {
            const banner = document.getElementById(id);
            if (!banner) return;
            banner.style.opacity = '0';
            banner.style.transform = 'translateY(-10px)';
            setTimeout(function() {
                if (banner && banner.parentNode) {
                    banner.remove();
                }
            }, 500);
        };

        const startTimer = function() {
            setTimeout(function() {
                dismissNotification('{{ $notificationId }}');
            }, 5000);
        };

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            startTimer();
        } else {
            document.addEventListener('DOMContentLoaded', startTimer);
        }
    })();
</script>
