<div x-data="{ open: @entangle('isOpen') }" x-cloak>
    <button x-on:click="open = true" class="relative focus:outline-none border-none shadow-none p-2">
        <flux:icon.bell class="w-6 h-6 text-gray-600 dark:text-gray-300" />
        @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
            <span
                class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 bg-red-600 text-white text-xs rounded-full">
                {{ auth()->user()->unreadNotifications()->count() }}
            </span>
        @endif
    </button>

    <!-- Slide-Over Panel -->
    <div x-show="open" x-on:click.outside="open = false"
        x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 w-80 md:w-[400px] z-50 bg-white dark:bg-gray-800">
        <flux:card class="h-full !rounded-none !p-2">
            <!-- Panel Header -->
            <div class="border-b relative p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Notifications
                </h3>

                <div class="mt-2 flex space-x-4 justify-between">
                    @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
                        <flux:link wire:click="markAllAsRead" class="text-sm border-none shadow-none cursor-pointer">
                            Mark All As Read
                        </flux:link>
                    @endif
                    <flux:link href="{{ route('notifications') }}"
                        class="text-sm border-none shadow-none cursor-pointer">
                        Show All
                    </flux:link>
                </div>

                <div class="absolute top-2 right-2">
                    <flux:button x-on:click="open = false" class="focus:outline-none border-none shadow-none">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </flux:button>
                </div>
            </div>

            <!-- Panel Content -->
            <div class="p-2 overflow-y-auto">
                @if ($notifications->count() > 0)
                    <ul>
                        @foreach ($notifications as $notification)
                            <li class="flex flex-col py-2 border-b space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold">
                                        {!! $notification->data['title'] ?? 'Notification' !!}
                                    </div>
                                    <flux:link wire:click="markAsRead('{{ $notification->id }}')"
                                        class="ml-4 text-xs border-none shadow-none cursor-pointer">
                                        Mark as Read
                                    </flux:link>
                                </div>
                                <div class="text-xs">
                                    {!! $notification->data['body'] ?? '' !!}
                                </div>
                                <div class="text-xs">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-4 text-sm">
                        No notifications
                    </div>
                @endif
            </div>
        </flux:card>
    </div>
</div>
