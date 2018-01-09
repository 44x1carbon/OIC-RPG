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
                <a href="#" class="rpg-top-menu-link status">
                    <div class="menu__name">
                        ステータス
                    </div>
                </a>
            </li>
            <li class="rpg-top-menu-item disabled">
                <a href="#" class="rpg-top-menu-link raid-battle">
                    <div class="menu__name">
                        レイドバトル
                    </div>
                </a>
            </li>
        </ul><!-- rpg-top-menu-list -->
        <div class="news">
            <div class="news__header">お知らせ</div>
            <ul class="topics news__body">
                <li class="topic">Ver1.2 アップデートのお知らせ</li>
                <li class="topic">現在起きている不具合について</li>
            </ul>
        </div>
    </div><!-- rpg-top -->
@endsection
