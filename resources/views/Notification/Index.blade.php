@extends('Shared._DefaultLayout')

@section('header_title')
    通知一覧
@endsection

@section('content')
<div>
    <?php /* @var \App\Infrastracture\Notification\NotificationViewModel $notification */ ?>
    @foreach($notifications as $notification)
        <a href="{{ route('show_notification_detail', ['notificationId' => $notification->id()]) }}" class="party">
            <div class="title">
                {{ $notification->title() }} {{$notification->isRead() ? '既読' : '未読'}}
            </div>
            <div class="notificationAt">
                {{ $notification->notificationAt()->format('Y/m/d  H:i:s') }}
            </div>
        </a>
    @endforeach
</div>
@endsection