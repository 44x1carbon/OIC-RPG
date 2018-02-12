@extends('Shared._DefaultLayout')

@section('header_title')
    Creater's Guild
@endsection

@section('content')
    <?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
    <div class="background">
        <div class="layer layer1 map"></div>
    </div><!-- background -->
    <div class="rpg-top">
        <div class="character-image" style="background-image: url('{{ $guildMember->favoriteJob()->characterImagePath() }}')">
        </div>
        <ul class="rpg-top-menu-list">
            <li class="rpg-top-menu-item">
                <a href="{{ route('show_guild') }}" class="rpg-top-menu-link guild">
                    <div class="menu__name">
                        ギルド
                    </div>
                </a>
            </li>
            <li class="rpg-top-menu-item">
                <a href="{{ route('show_my_page') }}" class="rpg-top-menu-link status">
                    <div class="menu__name">
                        ステータス
                    </div>
                </a>
            </li>
            <li class="rpg-top-menu-item notification">
                <a href="{{ route('show_notification') }}" class="rpg-top-menu-link notification {{ $sendNotification ? 'is-there' : ''}}">
                    <div class="menu__name">
                        通知  {{ $sendNotification ? 'あり' : 'なし'}}
                    </div>
                </a>
            </li>
        </ul><!-- rpg-top-menu-list -->
        <div class="news">
            <div class="news__header">お知らせ</div>
            <div class="topics news__body">
                <?php /* @var \App\Infrastracture\Feed\FeedViewModel $feed */ ?>
                @foreach($feedList as $feed)
                    <div class="card topic is-active">
                        <a href="{{ $feed->link()->partyUrl() }}">
                            {{ $feed->message() }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- rpg-top -->
    <script>
            var lenght = 0;
            var max = document.getElementsByClassName('topics').length
            topicswip = function() {
                document.getElementsByClassName('topic')[length].classList.toggle('is-active');
                if(max == length) {
                    length = 0
                } else {
                    length++
                }
                document.getElementsByClassName('topic')[length].classList.toggle('is-active');
            }
            if(max > 1) {
                setInterval(topicswip, 5000);
            }
    </script>
@endsection
