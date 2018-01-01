@extends('Shared._DefaultLayout')

@section('header_title')
    Holding
@endsection

@section('content')
    <div class="party-management">
    @include('guild.party.management._navgation')
       <ul class="party-management-list">
        <li class="party-management-item">
          <div class="party-management-join-item-left">
            <p>パーティー名</p>
            <p>ジョブ</p>
          </div>
          <div class="party-management-join-item-right">
            <button class="party-exit-btn">申請取消</button>
          </div>
        </li>
      </ul>
    </div>

@endsection
