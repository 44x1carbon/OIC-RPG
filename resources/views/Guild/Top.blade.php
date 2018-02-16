@extends('Shared._DefaultLayout')

@section('header_title')
    ギルド
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 guild-back"></div>
        <div class="layer layer2 mod-character mod-right">
            {{--<img src="{{ asset('images/f147.png') }}" alt="">--}}
            <img src="{{ asset('images/receptionist.png') }}" alt="">
            {{--<img src="{{ asset('images/f150.png') }}" alt="">--}}
            {{--<img src="{{ asset('images/f305.png') }}" alt="">--}}
        </div>
    </div>
    <div class="guild-top">
        <div class="guild-top__menu">
            <a href="{{ route('show_party_registration_production_idea') }}" class="btn mod-red">パーティー登録</a>
            <a href="{{ route('search_party') }}" class="btn mod-red">パーティー検索</a>
            <a href="{{ route('search_guild_member') }}" class="btn mod-red">スカウト</a>
        </div>
        <div class="guild-top__news"></div>
    </div>
@endsection