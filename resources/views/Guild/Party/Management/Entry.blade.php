@extends('Shared._DefaultLayout')

@section('header_title')
    Entry
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
@include('Guild.Party.Management._Navgation', ['name' => 'entry'])
<div class="party-management">
    <h2 class="party-management-title">参加中のパーティー一覧</h2>
    <ul class="party-list party-management-list">
        <?php /* @var \App\Infrastracture\Party\PartyViewModel $party */ ?>
        @foreach($entryParties as $index => $party)
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
                            <h4 class="party-management-body-title">役割</h4>
                            <div class="party-management-body-content">
                                <p>{{ $entryWantedRoleList[$party->id]->roleName }}</p>
                                <p>希望ジョブ：{{ $entryWantedRoleList[$party->id]->referenceJob()->name }}</p>
                            </div>
                        </div>
                        <div class="party-management-detail marginb">
                            <h4 class="party-management-body-title">活動期間</h4>
                            <div class="party-management-body-content">
                                <p>{{ $party->activityEndDate->format('Y/m/d') }}<span>まで</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection
