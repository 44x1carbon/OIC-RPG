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
                <form action="{{ route('search_party') }}" method="GET">
                    <div class="radio-wrap">
                        <input type="radio" name="radio" value="" id="serach-party" checked>
                        <label class="radio-name" for="serach-party">パーティー</label>
                        <input type="radio" name="radio" value="" id="serach-user">
                        <label class="radio-name" for="serach-user">ユーザー</label>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="input" placeholder="検索キーワード" name="keyword">
                    </div>
                    <button type="submit" class="btn">検索</button>
                </form>
            </div>
            <ul class="search_list">
                <?php /* @var App\Domain\Party\Party $party */ ?>
                @foreach($searchResult as $index => $party)
                    <li class="search_list-item">
                        <a href="#" class="list-item-link">
                            <div class="search_list-item-header">
                                <h3 class="search_list-item-title">{{ $party->productionIdea()->productionTheme() }}</h3>
                            </div>
                            <ul class="search_list-item-body">
                                <li class="party-seach_list-item-content-title">
                                    種類:
                                    <p class="party-seach_list-item-content">{{ $party->productionIdea()->productionType()->name() }}</p>
                                </li>
                                <li class="party-seach_list-item-content-title">
                                    説明:
                                    <p class="party-seach_list-item-content">
                                        {{ $party->productionIdea()->ideaDescription() }}
                                    </p>
                                </li>
                            </ul>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
@endsection
