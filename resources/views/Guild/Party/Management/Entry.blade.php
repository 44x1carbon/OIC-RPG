@extends('Shared._DefaultLayout')

@section('header_title')
    Entry
@endsection

@section('content')
    @include('guild.party.management._navgation')
    <ul class="party-management-list">
      <li class="party-management-item">
        <div class="party-management-join-item-left">
          <p class="party-managemnet-join-party-name">パーティー名</p>
          <p class="party-management-join-job">webエンジニア</p>
        </div>
        <div class="party-management-join-item-right">
          <button class="party-exit-btn" type="button">脱退</button>
        </div>
      </li>
    </ul>
@endsection
