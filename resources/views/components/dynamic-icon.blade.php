@props(['name'])

@switch($name)
    @case('users')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        @break
    @case('arrow-right')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
        @break
    @case('arrow-left')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        @break
    @case('code-2')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <path d="m18 16 4-4-4-4M6 8l-4 4 4 4M14.5 4l-5 16"/>
        </svg>
        @break
    @case('star')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
        </svg>
        @break
    @case('activity')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
        </svg>
        @break
    @default
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" {{ $attributes->merge(['class' => 'h-6 w-6']) }}>
            <circle cx="12" cy="12" r="10"></circle>
        </svg>
@endswitch
