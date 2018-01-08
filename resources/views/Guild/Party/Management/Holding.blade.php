@extends('Shared._DefaultLayout')

@section('header_title')
    Holding
@endsection

@section('content')
    @include('guild.party.management._navgation')
    <a class="applicant-list-move">申請者一覧</a>
    <ul class="party-management-list">
      <li class="party-management-item">
        <div class="party-management-holding-item-left">
          <p class="party-management-holding-status">募集中</p>
          <a href="#">編集</a>
        </div>
        <div class="party-management-holding-item-right">
          <p class="party-management-holding-party-name">パーティー名</p>
          <p class="party-management-holding-member">7/8人</p>
          <button class="party-dissolution" type="button">解散</button>
        </div>
      </li>
    </ul>
@endsection
