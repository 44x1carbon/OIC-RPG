@extends('Shared._DefaultLayout')

@section('header_title')
    Search
@endsection

@section('content')
        <div class="background">
            <div class="layer layer1 board"></div>
            <div class="layer layer2 opasity"></div>
        </div><!-- background -->
        <div class="search">
            <div class="search-warp">
                <div class="radio-wrap">
                    <input type="radio" name="radio" value="" id="serach-party" checked>
                    <label class="radio-name" for="serach-party">パーティー</label>
                    <input type="radio" name="radio" value="" id="serach-user">
                    <label class="radio-name" for="serach-user">ユーザー</label>
                </div>
                <div class="input-wrap">
                    <input type="text" class="input" placeholder="検索キーワード" name="">
                </div>
                <button type="button" class="btn">検索</button>
            </div>
            <ul class="search_list">
                <li class="search_list-item">
                    <a href="#" class="list-item-link">
                        <div class="search_list-item-header">
                            <h3 class="search_list-item-title">一緒にAndroidアプリ作りませんか？</h3>
                        </div>
                        <ul class="search_list-item-body">
                            <li class="party-seach_list-item-content-title">
                                種類:
                                <p class="party-seach_list-item-content">内容</p>
                            </li>
                            <li class="party-seach_list-item-content-title">
                                目標:
                                <p class="party-seach_list-item-content">内容</p>
                            </li>
                            <li class="party-seach_list-item-content-title">
                                説明:
                                <p class="party-seach_list-item-content">内容</p>
                            </li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
@endsection
