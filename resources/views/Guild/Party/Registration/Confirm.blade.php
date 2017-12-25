@extends('Shared._DefaultLayout')

@section('header_title')
    Confirm
@endsection

@section('content')
<div class="detail-party layer2">
    <form action="{{ route('store_party') }}" method="POST">
        {{ csrf_field() }}
        <div class="detail-party_header">
            <?php /* @var \App\Presentation\DTO\PartyDto $session */ ?>
            <h2 class="detail-party_title">テーマ：{{ $session->productionIdeaDto->productionTheme }}</h2>
            <input type="hidden" name="party[productionIdea][productionTheme]" value="{{ $session->productionIdeaDto->productionTheme }}">
        </div><!-- detail-party_header -->
        <div class="detail-party_body">
            <div class="detail-party_idea　detail-party_item-wrap">
                <div class="detail-party_item">
                    <h3 class="detail-party_item-title">制作物の種類</h3>
                    <p class="detail-party_item-content">
                        {{ $session->productionIdeaDto->productionTypeDto->name }}
                    </p>
                    <input type="hidden" name="party[productionIdea][productionTypeId]" value="{{ $session->productionIdeaDto->productionTypeDto->id }}">
                </div>
                <div class="detail-party_item">
                    <h3 class="detail-party_item-title">制作物の概要</h3>
                    <p class="detail-party_item-content">
                        {{ $session->productionIdeaDto->ideaDescription }}
                    </p>
                    <input type="hidden" name="party[productionIdea][ideaDescription]" value="{{ $session->productionIdeaDto->ideaDescription }}">
                </div>
            </div><!-- detail-party_idea -->
            <div class="detail-party_recruitment detail-party_item-wrap">
                <div class="detail-party_item">
                    <h3 class="detail-party_item-title">活動期間</h3>
                    <p class="detail-party_item-content">{{ $session->activityEndDate }}</p>
                    <input type="hidden" name="party[activityEndDate]" value="{{ $session->activityEndDate }}">
                </div>
                <div class="detail-party_item">
                    <h3 class="detail-party_item-title">募集内容</h3>
                    <p class="detail-party_item-content">内容</p>
                </div>
                <div class="detail-party_item">
                    <div class="detail-party_item-content">
                        <h3 class="detail-party_item-title">募集役割</h3>
                        <div class="detail-party_role-list">
                            <?php /* @var \App\Presentation\DTO\WantedRoleDto $wantedRoleDto */ ?>
                            @foreach( $session->wantedRoleDtos as $index => $wantedRoleDto)
                                <div class="detail-party_list-item">
                                    <div class="job-wrap"><!-- クラス名仮 -->
                                        <p>役割名:{{ $wantedRoleDto->roleName }}</p>
                                        <p>参考ジョブ名:{{ $wantedRoleDto->referenceJobName }}</p>
                                        <p>人数:{{ $wantedRoleDto->frameAmount }}</p>
                                        <p>{{ $wantedRoleDto->remarks }}</p>
                                        <input type="hidden" name="party[wantedRoleList][{{$index}}][roleName]" value="{{ $wantedRoleDto->roleName }}">
                                        <input type="hidden" name="party[wantedRoleList][{{$index}}][referenceJobId]" value="{{ $wantedRoleDto->referenceJobId }}">
                                        <input type="hidden" name="party[wantedRoleList][{{$index}}][frameAmount]" value="{{ $wantedRoleDto->frameAmount }}">
                                        <input type="hidden" name="party[wantedRoleList][{{$index}}][remarks]" value="{{ $wantedRoleDto->remarks }}">
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- detail-party_role-list -->
                    </div><!-- detail-party_item-content -->
                </div><!-- detail-party_item -->
            </div><!-- detail-party_recruitment -->
            <div class="detail-btn-wrap btn-wrap row flex-center-length">
                <button class="btn entry-button" type="submit">登録</button>
            </div>
        </div><!-- detail-party_body -->
    </form>
    {{ var_dump($errors->messages())  }}
</div><!-- detail-party -->

@endsection