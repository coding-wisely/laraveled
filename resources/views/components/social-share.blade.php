@props(['url'])

<div x-data="{ url: '{{ $url }}' }" class="flex space-x-2">
    <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url)" target="_blank"
       class="p-2  transition flex items-center justify-center w-8 h-8">
        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22.5 2h-3.6l-5.8 7.9L7.5 2H1.5l8.2 12.1L1.5 22h3.6l6.2-8.5L16.5 22h6l-9-13.3L22.5 2Z"></path>
        </svg>
    </a>

    <a :href="'https://www.linkedin.com/feed/?shareActive=true&shareUrl=' + encodeURIComponent(url)" target="_blank"
       class="p-2 transition flex items-center justify-center w-8 h-8">
        <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22.23 0H1.77C.8 0 0 .77 0 1.7V22.3c0 .93.8 1.7 1.77 1.7H22.2c.97 0 1.77-.77 1.77-1.7V1.7C24 .77 23.2 0 22.23 0zM7.07 20.4H3.56V8.9h3.51v11.5zM5.31 7.4c-1.13 0-2.05-.92-2.05-2.04 0-1.13.92-2.05 2.05-2.05 1.12 0 2.04.92 2.04 2.05 0 1.12-.92 2.04-2.04 2.04zm14.38 13H16.2v-5.6c0-1.33-.03-3.03-1.85-3.03-1.85 0-2.13 1.45-2.13 2.95v5.68H8.7V8.9h3.37v1.6h.05c.47-.88 1.62-1.81 3.34-1.81 3.57 0 4.23 2.35 4.23 5.4v6.3z"/>
        </svg>
    </a>
</div>
