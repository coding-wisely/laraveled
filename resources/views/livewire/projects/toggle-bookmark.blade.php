<flux:button wire:click="toggleBookmark" class="flex items-center  border-none ">
    @if ($bookmarked)
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5  text-red-600" viewBox="0 0 24 24" fill="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
        </svg>
    @endif
</flux:button>
