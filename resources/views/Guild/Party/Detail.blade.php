@extends('Shared._DefaultLayout')

@section('header_title')
    Detail
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
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
                    <div class="detail-party_role-list">
                        <div class="detail-party_list-item">
                            <h3 class="detail-party_item-title">募集役割</h3>
                            <div class="job-wrap"><!-- クラス名仮 -->
                                <p>参考ジョブ名</p>
                                <p>人数</p>
                            </div>
                        </div>
                        <div class="detail-party_list-item">
                            <h3 class="detail-party_item-title">募集役割</h3>
                            <div class="job-wrap"><!-- クラス名仮 -->
                                <p>参考ジョブ名</p>
                                <p>人数</p>
                            </div>
                        </div>
                    </div><!-- detail-party_role-list -->
                </div><!-- detail-party_item-content -->
            </div><!-- detail-party_item -->
        </div><!-- detail-party_recruitment -->
        <div class="detail-party_member detail-party_item-wrap">
            <h3 class="detail-party_member-title">メンバー</h3>
            <div class="detail-party_member-content">
                <div class="detail-party_member-list">
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                    <div class="detail-party_list-item member-item">
                        <img src="../assets/images/icon.jpg" class="member-icon">
                        <p>名前</p>
                        <p>役割</p>
                    </div>
                </div><!-- detail-party_member-list -->
            </div><!-- detail-party_member-content -->
        </div><!-- detail-party_member -->
        <div class="detail-btn-wrap btn-wrap row flex-center-length">
            <a href="#"><button class="btn entry-button">参加申請</button></a>
        </div>
    </div><!-- detail-party_body -->
</div><!-- detail-party -->
@endsection