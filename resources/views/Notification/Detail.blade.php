@extends('Shared._DefaultLayout')

@section('header_title')
    通知詳細
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 map"></div>
    <div class="layer layer2 opasity"></div>
</div><!-- background -->

    <div class="notification">
        <?php /* @var \App\Infrastracture\Notification\NotificationViewModel $notification */ ?>
        <div class="notification-header"> 
            <h2 class="notification-title">{{ $notification->title() }}</h2>
        </div>
        <div class="notification-body column flex-while">
            <p class="message">{!! $notification->message() !!}</p>
            @if($notification->notificationType()->is('receivePartyParticipationRequest'))
                @if($notification->link()->linkType()->is('partyParticipationRequest'))
                <div class="row flex-center-length">
                    <a href="{{ $notification->link()->url() }}" class="link">参加申請一覧を見る</a>
                </div>
                @endif
            @endif
        </div>
            @if($notification->notificationType()->is('replyPartyParticipationRequest'))
                @if($notification->link()->linkType()->is('partyParticipationRequest'))
i               <div class="row flex-center-length">
                    <a href="{{ $notification->link()->partyUrl() }}" class="link">パーティ詳細を見る</a>
                </div>
                @endif
            @endif
    </div>
@endsection
