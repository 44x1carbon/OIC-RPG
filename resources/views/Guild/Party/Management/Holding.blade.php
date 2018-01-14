@extends('Shared._DefaultLayout')

@section('header_title')
    Holding
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
@include('guild.party.management._navgation', ['name' => 'holding'])
<div class="party-management">
    <a class="applicant-list-move">申請者一覧</a>
    <h2 class="party-management-title">管理中のパーティー一覧</h2>
    <ul class="party-list party-management-list">
        <?php /* @var \App\Infrastracture\Party\PartyViewModel $party */ ?>
        @foreach($holdingParties as $index => $party)
            <li class="party-item party-management-item">
                <div class="party-header">
                    <p class="party-type">{{ $party->productionIdea()->productionType->name }}</p>
                    <h3 class="party-theme">{{ $party->productionIdea()->productionTheme }}</h3>
                </div>
                <div class="party-body row party-management-body">
                    <p class="party-body-left party-recruiting-status mod-yellow"></p>
                    <!-- 募集中= mod-yellow 募集終了= mod-gray -->
                    <div class="party-body-right">
                        <div class="party-management-detail">
                        </div>
                        <div class="party-management-detail marginb">
                            <h4 class="party-management-body-title">活動期間</h4>
                            <div class="party-management-body-content">
                                <p>{{ $party->activityEndDate->format('Y/m/d') }}<span>まで</span></p>
                            </div>
                        </div>
                        <div class="btn-wrap row flex-while">
                            <button class="btn mod-gray">解散</button>
                            <a href="{{ route('show_party_detail',['partyId' => $party->id]) }}" class="btn mod-light-green">詳細</a>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
