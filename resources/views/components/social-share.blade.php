@props(['url'])

<div x-data="{ url: '{{ $url }}' }" class="flex space-x-2">
    <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url)" target="_blank"
       class="p-2  transition flex items-center justify-center w-8 h-8">
       <flux:icon.twitter/>
    </a>

    <a :href="'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url)" target="_blank"
       class="p-2 transition flex items-center justify-center w-8 h-8">
        <flux:icon.linkedin />
    </a>
</div>
