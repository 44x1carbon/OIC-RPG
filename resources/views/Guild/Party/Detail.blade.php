@extends('Shared._DefaultLayout')

@section('header_title')
    パーティー詳細
@endsection

@section('content')
<?php /* @var \App\Infrastracture\Party\PartyViewModel $party */?>
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
<div class="party-detail content">
    <div class="party-detail__header content__header">
        <p>
            {{ $party->productionIdea()->productionTheme }}
        </p>
    </div>
    <div class="party-detail__body content__body">
        <div class="panel">
            <div class="panel__header mod-border">詳細</div>
            <p class="panel__body mod-light-filter">
                {{ $party->productionIdea()->ideaDiscription }}
            </p>
        </div>
        <div class="panel">
            <div class="panel__header mod-border">制作物の種類</div>
            <div class="panel__body mod-light-filter">
                {{ $party->productionIdea()->productionType->name }}
            </div>
        </div>
        <div class="panel">
            <div class="panel__header mod-border">
                活動期間
            </div>
            <div class="panel__body mod-light-filter">
                {{ $party->activityEndDate->format('Y/m/d') }}まで
            </div>
        </div>

        <div class="panel">
            <div class="panel__header mod-border">
                募集内容
            </div>
            <?php /* @var \App\Infrastracture\WantedRole\WantedRoleViewModel $wantedRole */ ?>
            @foreach($party->wantedRoles() as $wantedRole)
                <div class="wanted-role panel__body mod-light-filter panel">
                    <div class="wanted-role__name panel__header">{{ $wantedRole->roleName }}</div>

                    <div class="wanted-role__info panel__body">
                        <p class="wanted-role__remarks">
                            {{ $wantedRole->remarks }}
                        </p>
                        <div class="wanted-role__reference-job">希望ジョブ: {{ $wantedRole->referenceJob()->name }}</div>
                        <div class="wanted-role__frame">
                            募集枠: 残り{{ $wantedRole->assignableFrameNum }}枠({{ $wantedRole->assignedFrameNum }}/{{ $wantedRole->totalFrameNum }})
                        </div>

                        <div class="wanted-role__action flex-area mod-center">
                            <button class="btn mod-orange">参加したい！</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="member-list panel">
            <div class="member-list__header panel__header mod-border">パーティーメンバー</div>
            <div class="member-list__body flex-area panel__body mod-no-padding">
                <?php /* @var \App\Infrastracture\Party\PartyMemberInfoViewModel $partyMemberInfo */ ?>
                @foreach($party->partyMemberInfos() as $partyMemberInfo)
                    <div class="member-item">
                        <div class="member-item__role">{{ $partyMemberInfo->assigneeRole->roleName }}</div>
                        <div class="member-item__image">
                            <img src="{{ $partyMemberInfo->member()->favoriteJob()->mypImagePath() }}" class="member-icon">
                        </div>
                        <div class="member-item__name">{{ $partyMemberInfo->member()->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- detail-party_body -->
</div><!-- detail-party -->
@endsection