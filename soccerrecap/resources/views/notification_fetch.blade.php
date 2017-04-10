
@php
$notifications = \App\NotificationFollow::all();
@endphp

<a id="notification_seen" class="dropdown-toggle" data-toggle="dropdown" href="#">

    @if ($notifications->count())
        @foreach ($notifications as $notification)
            @if ($notification->alert_member_id == Auth::user()->id && $notification->status == 1)
                <i class="fa fa-circle" style="color: #ed5233;"></i>
            @else
                <i class="fa fa-circle font-color-blue"></i>
            @endif
        @endforeach
    @else
        <i class="fa fa-circle font-color-blue"></i>
    @endif

</a>

<ul class="dropdown-menu">

@if ($notifications->count())
    @foreach ($notifications as $notification)

        @if ($notification->alert_member_id == Auth::user()->id)

            @php
                $follows_member = \App\FollowsMember::find($notification->follows_id);
                $member = \App\Member::find($follows_member->member_id);
            @endphp
            <li>
                <a href="#" id="list-notification">
                    {{ $member->username }} follow you.
                    <span class="font-color-gray">
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $follows_member->created_at)->toFormattedDateString() }}
                    </span>
                </a>
            </li>

        @endif

    @endforeach
@else
    <li><a href="#" id="list-notification">No have notification.</a></li>
@endif

</ul>

<script>
    $(document).ready(function() {
       $('#notification_seen').on('click', function() {
           $.post('{{ url('notification/seen') }}',
           {
               _token: '{{ csrf_token() }}',
               member_id: '{{ Auth::user()->id }}'
           },
           function(data, status) {
//               console.log("Data: " + data + "\nStatus: " + status);
           });
       }) ;
    });
</script>


