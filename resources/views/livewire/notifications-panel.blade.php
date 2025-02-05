<div x-data="{ open: @entangle('isOpen') }" x-cloak>
    <button x-on:click="open = true" class="relative focus:outline-none border-none shadow-none p-2">
        <flux:icon.bell class="w-6 h-6 text-gray-600 dark:text-gray-300" />
        @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
            <span class="absolute top-0 right-0 block w-2 h-2 bg-red-600 rounded-full"></span>
        @endif
    </button>

    <div x-show="open" x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" class="fixed inset-y-0 right-0 w-80 md:w-[400px] z-50">

        <flux:card class="h-full rounded-none">
            <div class="border-b relative p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Notifications
                </h3>

                @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
                    <div class="mt-2">
                        <flux:link wire:click="markAllAsRead" class="text-sm border-none shadow-none cursor-pointer">
                            Mark All As Read
                        </flux:link>
                    </div>
                @endif

                <div class="absolute top-2 right-2">
                    <flux:button x-on:click="open = false"
                        class="text-gray-600 dark:text-gray-300 focus:outline-none border-none shadow-none">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </flux:button>
                </div>
            </div>

            <!-- Panel Content -->
            <div class="p-2 overflow-y-auto">
                @if ($notifications->count() > 0)
                    <ul>
                        @foreach ($notifications as $notification)
                            <li class="flex flex-col py-2 border-b space-y-2 ">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold">
                                        {!! $notification->data['title'] ?? 'Notification' !!}
                                    </div>
                                    <flux:link wire:click="markAsRead('{{ $notification->id }}')"
                                        class="ml-4 text-xs border-none shadow-none cursor-pointer">
                                        Mark as Read
                                    </flux:link>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {!! $notification->data['body'] ?? '' !!}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-4 text-sm text-gray-500 dark:text-gray-400">
                        No notifications
                    </div>
                @endif
            </div>
        </flux:card>
    </div>
</div>
