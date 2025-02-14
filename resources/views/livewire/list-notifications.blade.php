    <flux:card >
        <flux:card class="flex items-center justify-between mb-2">
            <flux:heading >Notifications</flux:heading>
            @if (auth()->check() && auth()->user()->unreadNotifications()->count() > 0)
                <flux:link wire:click="markAllAsRead" class="text-xs cursor-pointer">
                    Mark All As Read
                </flux:link>
            @endif
        </flux:card>

        <!-- Desktop/Tablet View (visible on larger screens) -->
        <div class="overflow-x-auto hidden sm:block">
            <flux:table>
                <flux:columns>
                    <flux:column>Notification</flux:column>
                    <flux:column>Date</flux:column>
                    <flux:column>Delete</flux:column>
                </flux:columns>

                <flux:rows>
                    @foreach ($notifications as $notification)
                        <flux:row>
                            <flux:cell>
                                <div class="flex items-center justify-start">
                                    <div>
                                        <div class="text-sm">
                                            {!! $notification->data['body'] ?? '' !!}
                                        </div>
                                    </div>
                                    @if (!$notification->read_at)
                                        <flux:link wire:click="markAsRead('{{ $notification->id }}')" class="ml-2 cursor-pointer" title="Mark as Read">
                                            <flux:tooltip content="Mark as Read">
                                                <flux:icon name="check" class="w-4 h-4" />
                                            </flux:tooltip>
                                        </flux:link>
                                    @endif

                                </div>
                            </flux:cell>

                            <flux:cell class=" text-sm">
                                {{ $notification->created_at->format('d M, Y g:i A') }}
                            </flux:cell>

                            <flux:cell class="text-center">
                                <flux:link wire:click="clear('{{ $notification->id }}')"
                                    class="text-sm cursor-pointer">
                                    <flux:tooltip content="Delete">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:tooltip>
                                </flux:link>
                            </flux:cell>
                        </flux:row>
                    @endforeach
                </flux:rows>
            </flux:table>
        </div>

        <!-- Mobile/Card View (visible on extra-small screens) -->
        <div class="block sm:hidden">
            @foreach ($notifications as $notification)
                <flux:card class="mb-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs">
                                {!! $notification->data['body'] ?? '' !!}
                            </div>
                        </div>
                        @if (!$notification->read_at)
                            <flux:link wire:click="markAsRead('{{ $notification->id }}')"
                                class="ml-2 cursor-pointer" title="Mark as Read">
                                <flux:tooltip content="Mark as Read">
                                    <flux:icon name="check" class="w-4 h-4" />
                                </flux:tooltip>
                            </flux:link>
                         @endif
                    </div>
                    <div class="text-xs mt-2">
                        {{ $notification->created_at->format('d M, Y g:i A') }}
                    </div>
                    <div class="flex justify-end mt-2">
                        <flux:link wire:click="clear('{{ $notification->id }}')" class="text-sm cursor-pointer">
                            <flux:tooltip content="Delete">
                                <flux:icon name="trash" class="w-4 h-4" />
                            </flux:tooltip>
                        </flux:link>
                    </div>
                </flux:card>
            @endforeach
        </div>
    </flux:card>
