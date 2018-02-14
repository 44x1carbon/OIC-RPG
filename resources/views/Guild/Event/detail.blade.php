@extends('Shared._DefaultLayout')

@section('header_title')
    パーティー詳細
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 opasity"></div>
</div><!-- background -->
<div class="event-detail map">
  <div class="event-detail-heading">
    <p class="event-detail-duration">2017/2/15 ~ 2017/2/17</p>
  </div>
  <div class="event-detail-body">
    <div class="event-detail-title">
     <h3>メディアフロンティア杯</h3>
     <div class="panel event-detail-theme">
        <h4 class="panel__header color-white text-center">テーマ：輪</h4>
     </div>
    </div>
    <div class="panel">
      <h4 class="panel__header mod-border">説明</h4>
      <p class="panel__body mod-light-filter">
        メディアフロンティア開催中に行います。
      </p>
    </div>
    <div class="btn-wrap row flex-center-length">
      <button type="button" class="btn mod-green btn-large">エントリーする</button>
    </div>
    <div class="panel">
      <h4 class="panel__header mod-border">エントリー作品</h4>
      <div class="panel__body mod-light-filter">
        <ul class="event-detail-join-team">
          <li>リアルタイム道案内システム（小島）</li>
          <li>Creater's Guild（山崎）</li>
          <li>Cocoa cafe（柿本）</li>
          <li>リアルジュース（山崎）</li>
          <li>bookshelf（飛田）</li>
        <ul>
        <p class="text-right">他</p>
      </div>
    </div>
    <div class="btn-wrap row flex-center-length">
      <a type="button" class="btn mod-blue btn-large">ランキングをみる</a>
    </div>
  </div>
</div>
@endsection
