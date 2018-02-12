@extends('Shared._DefaultLayout')

@section('header_title')
    通知一覧
@endsection

@section('content')
<div class="background">
    <div class="layer layer1" style="background: #333"></div>
</div><!-- background -->
<div class="notification">
    <div class="notification-header">
        <h2 class="notification-title">通知</h2>
    </div>
    <?php /* @var \App\Infrastracture\Notification\NotificationViewModel $notification */ ?>
    <ul class="notification-list">
    @foreach($notifications as $notification)
        @if($notification->isRead())
        <li class="notification-item is-read">
        @else
        <li class="notification-item">
        @endif
            <a href="{{ route('show_notification_detail', ['notificationId' => $notification->id()]) }}" class="party">
                <div class="title">
                    <p class="new"> {{$notification->isRead() ? '' : 'NEW'}}</p>
                    <p>{{ $notification->title() }}</p>
                </div>
                <div class="notificationAt">
                    {{ $notification->notificationAt()->format('Y/m/d  H:i:s') }}
                </div>
            </a>
        </li>
    @endforeach
    </ul>
</div>
@endsection
