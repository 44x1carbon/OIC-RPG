@extends('Shared._DefaultLayout')

@section('header_title')
    通知詳細
@endsection

@section('content')
    <div>
        <?php /* @var \App\Infrastracture\Notification\NotificationViewModel $notification */ ?>
        <div> {{ $notification->title() }}</div>
        <div> {{ $notification->message() }} </div>
            <a href="{{ route('show_notification') }}" class="notification-title">通知一覧</a>
            @if($notification->notificationType()->is('receivePartyParticipationRequest'))
                @if($notification->link()->linkType()->is('partyParticipationRequest'))
                    <a href="{{ $notification->link()->url() }}" class="party">参加申請一覧</a>
                @endif
            @endif
            @if($notification->notificationType()->is('replyPartyParticipationRequest'))
                @if($notification->link()->linkType()->is('partyParticipationRequest'))
                    <a href="{{ $notification->link()->partyUrl() }}" class="party">パーティ</a>
                @endif
            @endif
    </div>
@endsection
