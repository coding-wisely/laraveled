<div class="container mx-auto p-6">
    <!-- User Profile Card -->
    <flux:card class="bg-gray-100 dark:bg-gray-800 shadow-md rounded-lg">
        <div class="flex flex-col md:flex-row items-center space-y-10 md:space-y-0 md:space-x-10">
            <flux:card class="border-none w-32 h-32 !p-0">
                <img src="{{ $user->getAvatarUrl() ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=150&background=random' }}"
                    alt="Profile Picture" class="object-cover">
            </flux:card>

            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $user->name }}
                </h2>

                @if (!$companies->isNotEmpty())
                    <p class="text-gray-600 dark:text-gray-300">
                        No Company
                    </p>
                @endif

                <p class="text-yellow-500 font-semibold mt-1">
                    ⭐ {{ number_format($averageRating, 1) }}/5
                </p>

                <div class="mt-3 text-gray-700 dark:text-gray-300 text-sm space-y-1">
                    @if ($user->email)
                        <p>📧 <span class="font-medium">{{ $user->email }}</span></p>
                    @endif
                    <p>📅 Joined {{ $user->created_at->format('F Y') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex justify-center md:justify-start space-x-4 mt-2">
                @if ($user->github)
                    <flux:link href="{{ $user->github }}" target="_blank" class="text-gray-800 dark:text-gray-200">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.167 6.839 9.49.5.09.682-.217.682-.482 0-.237-.009-.866-.014-1.7-2.782.603-3.369-1.34-3.369-1.34-.455-1.156-1.11-1.464-1.11-1.464-.907-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.89 1.525 2.335 1.085 2.904.83.091-.645.348-1.085.635-1.335-2.22-.253-4.555-1.11-4.555-4.94 0-1.09.39-1.98 1.029-2.68-.103-.253-.446-1.27.097-2.645 0 0 .84-.268 2.75 1.025A9.564 9.564 0 0 1 12 6.845c.85.004 1.705.114 2.505.334 1.91-1.293 2.75-1.025 2.75-1.025.543 1.375.2 2.392.097 2.645.64.7 1.029 1.59 1.029 2.68 0 3.84-2.34 4.685-4.565 4.935.36.31.678.924.678 1.86 0 1.345-.012 2.425-.012 2.755 0 .268.18.577.688.48C19.14 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                        </svg>
                    </flux:link>
                @endif
                @if ($user->twitter)
                    <flux:link href="{{ $user->twitter }}" target="_blank" class="text-blue-400 hover:text-blue-500">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M23.444 4.834a9.167 9.167 0 0 1-2.713.772 4.775 4.775 0 0 0 2.084-2.646 9.551 9.551 0 0 1-3.01 1.187 4.75 4.75 0 0 0-8.093 4.326A13.466 13.466 0 0 1 2.83 3.58a4.75 4.75 0 0 0 1.46 6.34 4.72 4.72 0 0 1-2.15-.6v.06a4.75 4.75 0 0 0 3.8 4.66 4.743 4.743 0 0 1-2.14.08 4.75 4.75 0 0 0 4.45 3.29 9.54 9.54 0 0 1-5.94 2.04c-.385 0-.768-.023-1.15-.07a13.42 13.42 0 0 0 7.26 2.14c8.717 0 13.489-7.355 13.489-13.74 0-.21-.005-.42-.014-.63a9.774 9.774 0 0 0 2.392-2.48z" />
                        </svg>
                    </flux:link>
                @endif
                @if ($user->linkedin)
                    <flux:link href="{{ $user->linkedin }}" target="_blank"
                        class="text-blue-800 dark:text-blue-500 hover:text-blue-600">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5c0 1.38-1.12 2.5-2.5 2.5S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.38 8.5H5v13H.38v-13zm7.53 0h4.46v1.78h.06c.62-1.18 2.14-2.42 4.4-2.42 4.71 0 5.58 3.1 5.58 7.14v8.5h-4.65v-7.54c0-1.8-.04-4.12-2.52-4.12-2.52 0-2.91 1.97-2.91 4v7.66H7.91v-13z" />
                        </svg>
                    </flux:link>
                @endif
            </div>
        </div>
    </flux:card>

    @if ($user->companies->isNotEmpty())
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Company Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($user->companies as $company)
                    <flux:card class=" p-4 shadow rounded-lg">
                        <div class="flex justify-center">
                            <img src="{{ $company->getFirstMediaUrl('companies') }}" alt="{{ $company->title }}"
                                class="w-24 h-24 object-cover">
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $company->name }}</h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $company->description ?? 'No description available' }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">📍
                            {{ $company->location ?? 'No location specified' }}</p>
                        @if ($company->website)
                            <a href="{{ $company->website }}" target="_blank"
                                class="text-blue-500 hover:underline mt-2 block">
                                🌍 Visit Website
                            </a>
                        @endif
                    </flux:card>
                @endforeach
            </div>
        </div>
    @endif


    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Projects Submitted</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <p class="text-gray-600 dark:text-gray-400">No projects submitted yet.</p>
            @endforelse
        </div>
    </div>
</div>
