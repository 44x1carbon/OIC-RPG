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
            <div class="row flex-center-length">
                <a href="{{ $notification->link()->url() }}" class="link">{{ $notification->link()->label() }}</a>
            </div>
        </div>
    </div>
@endsection
