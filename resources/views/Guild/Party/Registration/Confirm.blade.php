@extends('Shared._DefaultLayout')

@section('header_title')
    パーティー登録
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->

<div class="detail-party content layer2">
    <form action="{{ route('store_party') }}" method="POST">
        {{ csrf_field() }}
        <div class="party-detail__header content__header">
            <?php /* @var \App\Presentation\DTO\PartyDto $session */ ?>
            <p class="detail-party_title">{{ $session->productionIdeaDto->productionTheme }}</p>
            <input type="hidden" name="party[productionIdea][productionTheme]" value="{{ $session->productionIdeaDto->productionTheme }}">
        </div><!-- detail-party_header -->
        <div class="party-detail__body content__body">
                <div class="panel">
                    <h3 class="panel__header mod-border">詳細</h3>
                    <p class="panel__body mod-light-filter">
                        {{ $session->productionIdeaDto->ideaDescription }}
                    </p>
                    <input type="hidden" name="party[productionIdea][ideaDescription]" value="{{ $session->productionIdeaDto->ideaDescription }}">
                </div>
                <div class="panel">
                    <h3 class="panel__header mod-border">制作物の種類</h3>
                    <p class="panel__body mod-light-filter">
                        {{ $session->productionIdeaDto->productionTypeDto->name }}
                    </p>
                    <input type="hidden" name="party[productionIdea][productionTypeId]" value="{{ $session->productionIdeaDto->productionTypeDto->id }}">
                </div>
                <div class="panel">
                    <h3 class="panel__header mod-border">活動期間</h3>
                    <p class="panel__body mod-light-filter">{{ $session->activityEndDate }}</p>
                    <input type="hidden" name="party[activityEndDate]" value="{{ $session->activityEndDate }}">
                </div>
                <div class="panel">
                    <h3 class="panel__header mod-border">募集内容</h3>
                    <?php /* @var \App\Presentation\DTO\WantedRoleDto $wantedRoleDto */ ?>
                    @foreach( $session->wantedRoleDtos as $index => $wantedRoleDto)
                        <div class="wanted-role panel__body mod-light-filter panel">
                            <h4 class="wanted-role__name panel__header">{{ $wantedRoleDto->roleName }}</h4>
                            <div class="wanted-role__info panel__body">
                                <p class="wanted-role__remarks">{{ $wantedRoleDto->remarks }}</p>
                                <p class="wanted-role__reference-job">希望ジョブ：{{ $wantedRoleDto->referenceJobName }}</p>
                                <p class="wanted-role__frame">募集枠: {{ $wantedRoleDto->frameAmount }}</p>
                                <input type="hidden" name="party[wantedRoleList][{{$index}}][roleName]" value="{{ $wantedRoleDto->roleName }}">
                                <input type="hidden" name="party[wantedRoleList][{{$index}}][referenceJobId]" value="{{ $wantedRoleDto->referenceJobId }}">
                                <input type="hidden" name="party[wantedRoleList][{{$index}}][frameAmount]" value="{{ $wantedRoleDto->frameAmount }}">
                                <input type="hidden" name="party[wantedRoleList][{{$index}}][remarks]" value="{{ $wantedRoleDto->remarks }}">
                                <input type="hidden" name="party[wantedRoleList][{{$index}}][managerAssigned]" value="{{ $wantedRoleDto->managerAssigned }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            <div class="detail-btn-wrap btn-wrap row flex-center-length">
                <button class="btn mod-orange" type="submit">登録</button>
            </div>
        </div><!-- detail-party_body -->
    </form>
</div><!-- detail-party -->

@endsection
