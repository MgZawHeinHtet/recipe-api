<x-profile-layout>

    <div class="w-[90%] noti-container mx-auto  shadow-lg ">
        <div class="p-10 flex items-center justify-between">
            <h4 class="font-semibold text-xl tracking-wider">Notifications</h4>
            <form action="/profile/notifications/read" method="POST">
                @csrf

                <button type="submit" class="text-sm font-normal tracking-wide"><i
                        class="fa-solid fa-check-double text-green-500 mr-2"></i>Make all as read</button>
            </form>
        </div>
        <hr>

        @if ($unread_notifications->count())

            <h6 class="px-10 py-4 text-base tracking-wide">New</h6>
            @foreach ($unread_notifications as $notification)
                <x-noti-card :notification="$notification"></x-noti-card>
            @endforeach
        @endif

        @if ($read_notifications->count() )

            <h6 class="px-10 py-4 text-base tracking-wide">Recent</h6>
            @foreach ($read_notifications as $notification)
                <x-noti-card :notification="$notification"></x-noti-card>
            @endforeach
        @endif

        @if (!$unread_notifications->count() && !$read_notifications->count())
            <div class="w-full h-[500px] flex items-center justify-center">
                <p>There haven't notifications</p>
            </div>
        @endif
    </div>
</x-profile-layout>
