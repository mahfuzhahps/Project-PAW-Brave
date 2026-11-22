<svg class="brave-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    @switch($name)
        @case('grid')
            <rect x="4" y="4" width="6" height="6" rx="1" />
            <rect x="14" y="4" width="6" height="6" rx="1" />
            <rect x="4" y="14" width="6" height="6" rx="1" />
            <rect x="14" y="14" width="6" height="6" rx="1" />
            @break
        @case('calendar')
            <rect x="4" y="5" width="16" height="15" rx="2" />
            <path d="M8 3v4m8-4v4M4 10h16m-11 4h1m4 0h1m-6 3h1" />
            @break
        @case('clock')
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3 2" />
            @break
        @case('check')
            <path d="m6 12 4 4 8-9" />
            @break
        @case('close')
            <path d="m7 7 10 10M17 7 7 17" />
            @break
        @case('arrow')
            <path d="M5 12h14m-5-5 5 5-5 5" />
            @break
        @case('logout')
            <path d="M10 4H5v16h5m4-12 4 4-4 4m-5-4h13" />
            @break
        @case('note')
            <path d="M6 3h12v13l-5 5H6V3Zm7 18v-5h5M9 7h6m-6 4h6m-6 4h2" />
            @break
        @case('picture')
            <rect x="4" y="4" width="16" height="16" rx="1" />
            <path d="m4 16 5-5 3 3 3-4 5 5M8 8h.01" />
            @break
    @endswitch
</svg>
