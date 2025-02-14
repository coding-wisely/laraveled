<div class="flux-container mx-auto p-4">
    <div class="flux-card bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flux-card-header p-4 bg-gray-200">
            <h1 class="flux-title text-xl font-bold">Notifications</h1>
        </div>
        <div class="flux-card-body p-4">
            @if ($notifications->count())
                <table class="flux-table w-full">
                    <thead>
                        <tr>
                            <th class="flux-th p-2 border-b">ID</th>
                            <th class="flux-th p-2 border-b">Type</th>
                            <th class="flux-th p-2 border-b">Data</th>
                            <th class="flux-th p-2 border-b">Status</th>
                            <th class="flux-th p-2 border-b">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td class="flux-td p-2 border-b">{{ $notification->id }}</td>
                                <td class="flux-td p-2 border-b">{{ class_basename($notification->type) }}</td>
                                <td class="flux-td p-2 border-b">{{ json_encode($notification->data) }}</td>
                                <td class="flux-td p-2 border-b">
                                    @if ($notification->read_at)
                                        <span class="text-green-500">Read</span>
                                    @else
                                        <span class="text-red-500">Unread</span>
                                    @endif
                                </td>
                                <td class="flux-td p-2 border-b">{{ $notification->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flux-empty p-4 text-center">
                    No notifications found.
                </div>
            @endif
        </div>
    </div>
</div>
