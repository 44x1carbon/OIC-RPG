@extends('Shared._DefaultLayout')

@section('header_title')
    パーティー登録
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 board"></div>
    </div><!-- background -->
    <div class="entry layer2">
        <div class="entry-header">
            <h2 class="entry-title">制作内容</h2>
        </div><!-- entry-header -->
        <div class="entry-body body-color party-entry-body">
            <?php /* @var \App\Presentation\DTO\PartyDto $session */ ?>
            <form class="form" action="{{ route('do_party_registration_production_idea') }}" method="post">
                {{ csrf_field() }}
                <div class="item form-item">
                    <h3 class="form-item-title">テーマ</h3>
                    <input type="text" class="input" name="party[productionIdea][productionTheme]" value="{{ $session->productionIdeaDto()->productionTheme }}"><!-- テーマ -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">種類</h3>
                    <select class="input select" name="party[productionIdea][productionTypeId]" id="">
                        @foreach($productionTypes as $productionType)
                            <option value="{{ $productionType->id() }}" {{ $session->productionIdeaDto()->productionTypeDto->id == $productionType->id()? 'selected' : '' }}>{{ $productionType->name() }}</option>
                        @endforeach
                    </select><!-- 種類 -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">詳細</h3>
                    <textarea class="input textarea" name="party[productionIdea][ideaDescription]">{{ $session->productionIdeaDto()->ideaDescription }}</textarea><!-- 説明 -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">活動期間</h3>
                    <input type="date" class="input" name="party[activityEndDate]" value="{{ $session->activityEndDate }}"><!-- 活動期間 -->
                </div><!-- item -->
                <div class="btn-wrap row flex-end-side flex-end-length">
                    <button class="btn mod-blue" type="submit">次へ</button>
                </div><!-- btn-wrap -->
            </form><!-- form -->
        </div><!-- entry-body -->
    </div><!-- entry -->
@endsection
