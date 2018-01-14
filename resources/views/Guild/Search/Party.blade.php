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
                    <h2 class="search-title">検索条件</h2>
                    <div class="input-wrap">
                        <input type="text" class="input search-input" placeholder="検索キーワード" name="keyword">
                        <button type="submit" class="btn btn-small mod-green search-submit">検索</button>
                    </div>
                </form>
            </div>
            <ul class="party-list">
                <?php /* @var \App\Infrastracture\Party\PartyViewModel $party */ ?>
                @foreach($searchResult as $index => $party)
                    <li class="party-list-item map">
                        <a href="{{ route('show_party_detail', ['partyId' => $party->id]) }}" class="party">
                            <div class="party-header">
                                <p class="party-type">{{ $party->productionIdea()->productionType->name }}</p>
                                <h3 class="party-theme">{{ $party->productionIdea()->productionTheme }}</h3>
                            </div>
                            <div class="party-body">
                                <h4 class="party-body-title">募集中の役割</h4>
                                <ul class="party-wanted_role-list">
                                    <?php /* @var \App\Infrastracture\WantedRole\WantedRoleViewModel $wantedRole */ ?>
                                    @foreach($party->wantedRoles() as $wantedRole)
                                        <li class="party-wanted_role-item row flex-center before">
                                            <div class="party-wanted_role-content">
                                                <p class="party-wanted_role-name">{{ $wantedRole->roleName }}</p>
                                                <p class="party-wanted_role-reference_job">希望ジョブ：{{ $wantedRole->referenceJob()->name }}</p>
                                            </div>
                                            @if($wantedRole->isFrameFull())
                                                <p class="party-wanted_role-status mod-red">満員</p>
                                            @endif

                                            @if($wantedRole->isFrameEmpty())
                                                <p class="party-wanted_role-status mod-green">空き</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
@endsection
