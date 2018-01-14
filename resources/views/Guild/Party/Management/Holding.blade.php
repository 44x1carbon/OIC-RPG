@extends('Shared._DefaultLayout')

@section('header_title')
    Holding
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
@include('guild.party.management._navgation')
<div class="party-management">
    <a class="applicant-list-move">申請者一覧</a>
    <h2 class="party-management-title">管理中のパーティー一覧</h2>
    <ul class="party-list party-management-list">
        <li class="party-item party-management-item">
            <div class="party-header">
                <p class="party-type">Webシステム</p>
                <h3 class="party-theme">学内の共同政策を推進するサービス</h3>
            </div>
            <div class="party-body row party-management-body">
                <p class="party-body-left party-recruiting-status mod-yellow">募集中</p>
                <div class="party-body-right">
                    <div class="party-management-detail">
                        <h4 class="party-management-body-title">役割</h4>
                        <div class="party-management-body-content">
                            <p>Webデザイナー</p>
                            <p>希望ジョブ：Webデザイナー</p>
                        </div>
                    </div>
                    <div class="party-management-detail marginb">
                        <h4 class="party-management-body-title">活動期間</h4>
                        <div class="party-management-body-content">
                            <p>2017/11/10 ~ 2018/01/18<span>まで</span></p>
                        </div>
                    </div>
                    <div class="btn-wrap row flex-while">
                        <button class="btn mod-gray">解散</button>
                        <button class="btn mod-light-green">詳細</button>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    </section>
</div>
@endsection
