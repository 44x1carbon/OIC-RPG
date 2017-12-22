@extends('Shared._DefaultLayout')

@section('header_title')
    Confirm
@endsection

@section('content')
<div class="detail-party layer2">
    <div class="detail-party_header">
        <h2 class="detail-party_title">テーマ</h2>
    </div><!-- detail-party_header -->
    <div class="detail-party_body">
        <div class="detail-party_idea　detail-party_item-wrap">
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">種類</h3>
                <p class="detail-party_item-content">内容</p>
            </div>
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">説明</h3>
                <p class="detail-party_item-content">内容</p>
            </div>
        </div><!-- detail-party_idea -->
        <div class="detail-party_recruitment detail-party_item-wrap">
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">活動期間</h3>
                <p class="detail-party_item-content">内容</p>
            </div>
            <div class="detail-party_item">
                <h3 class="detail-party_item-title">募集内容</h3>
                <p class="detail-party_item-content">内容</p>
            </div>
            <div class="detail-party_item">
                <div class="detail-party_item-content">
                    <h3 class="detail-party_item-title">募集役割</h3>
                    <div class="detail-party_role-list">
                        <div class="detail-party_list-item">
                            <div class="job-wrap"><!-- クラス名仮 -->
                                <p>役割名</p>
                                <p>参考ジョブ名</p>
                                <p>人数</p>
                                <p>備考</p>
                            </div>
                        </div>
                        <div class="detail-party_list-item">
                            <div class="job-wrap"><!-- クラス名仮 -->
                                <p>役割名</p>
                                <p>参考ジョブ名</p>
                                <p>人数</p>
                                <p>備考</p>
                            </div>
                        </div>
                    </div><!-- detail-party_role-list -->
                </div><!-- detail-party_item-content -->
            </div><!-- detail-party_item -->
        </div><!-- detail-party_recruitment -->
        <div class="detail-btn-wrap btn-wrap row flex-center-length">
            <button class="btn entry-button" type="submit">登録</button>
        </div>
    </div><!-- detail-party_body -->
</div><!-- detail-party -->

@endsection