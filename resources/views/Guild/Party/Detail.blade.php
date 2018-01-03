@extends('Shared._DefaultLayout')

@section('header_title')
    Detail
@endsection

@section('content')
<?php /* @var \App\Infrastracture\Party\PartyViewModel $party */?>
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
<div class="detail-party layer2">
    <div class="detail-party_header">
        <h2 class="detail-party_title">テーマ:{{ $party->productionIdea()->productionTheme }}</h2>
    </div><!-- detail-party_header -->
    <div class="detail-party_body">
        <div class="detail-party_idea　detail-party_item-wrap">
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">種類</h3>
                <p class="detail-party_item-content">{{ $party->productionIdea()->productionType->name }}</p>
            </div>
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">説明</h3>
                <p class="detail-party_item-content">
                    {{ $party->productionIdea()->ideaDiscription }}
                </p>
            </div>
        </div><!-- detail-party_idea -->
        <div class="detail-party_recruitment detail-party_item-wrap">
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">活動期間</h3>
                <p class="detail-party_item-content">{{ $party->activityEndDate->format('Y/m/d') }}</p>
            </div>
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">募集内容</h3>
                <p class="detail-party_item-content">内容</p>
            </div>
            <div class="detail-party_item">
                <div class="detail-party_item-content">
                    <div class="detail-party_role-list">
                        <?php /* @var \App\Infrastracture\WantedRole\WantedRoleViewModel $wantedRole */ ?>
                        @foreach($party->wantedRoles() as $wantedRole)
                            <div class="detail-party_list-item">
                                <h3 class="detail-party_item-title">{{ $wantedRole->roleName }}</h3>
                                <div class="job-wrap"><!-- クラス名仮 -->
                                    <p>参考ジョブ名:{{ $wantedRole->referenceJob()->name }}</p>
                                    <p>
                                        募集人数:{{ $wantedRole->assignedFrameNum }}人<br>
                                        参加状況:{{ $wantedRole->assignedFrameNum }}/{{ $wantedRole->totalFrameNum }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- detail-party_role-list -->
                </div><!-- detail-party_item-content -->
            </div><!-- detail-party_item -->
        </div><!-- detail-party_recruitment -->
        <div class="detail-party_member detail-party_item-wrap">
            <h3 class="detail-party_member-title">メンバー</h3>
            <div class="detail-party_member-content">
                <div class="detail-party_member-list">
                    <?php /* @var \App\Infrastracture\Party\PartyMemberInfoViewModel $partyMemberInfo */ ?>
                    @foreach($party->partyMemberInfos() as $partyMemberInfo)
                    <div class="detail-party_list-item member-item">
                        <img src="{{ $partyMemberInfo->member()->favoriteJob()->mypImagePath() }}" class="member-icon">
                        <p>{{ $partyMemberInfo->member()->name }}</p>
                        <p>{{ $partyMemberInfo->assigneeRole->roleName }}</p>
                    </div>
                    @endforeach
                </div><!-- detail-party_member-list -->
            </div><!-- detail-party_member-content -->
        </div><!-- detail-party_member -->
        <div class="detail-btn-wrap btn-wrap row flex-center-length">
            <a href="#"><button class="btn entry-button">参加申請</button></a>
        </div>
    </div><!-- detail-party_body -->
</div><!-- detail-party -->
@endsection