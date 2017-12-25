@extends('Shared._DefaultLayout')

@section('header_title')
    Edit
@endsection

@section('content')
<div class="background">
    <div class="layer layer1 board"></div>
</div><!-- background -->
<div class="entry layer2 entry-color">
    <div class="entry-header">
        <h2 class="entry-title">パーティー情報編集</h2>
    </div><!-- entry-header -->
    <div class="entry-body">
        <h2 class="entry-title">制作内容</h2>
        <div class="item form-item">
            <h3 class="form-item-title">テーマ</h3>
            <input type="text" class="input">
        </div><!-- item -->
        <div class="item form-item">
            <h3 class="form-item-title">種類</h3>
            <input type="text" class="input">
        </div><!-- item -->
        <div class="item form-item">
            <h3 class="form-item-title">説明</h3>
            <input type="text" class="input input-large">
        </div><!-- item -->
        <div class="item form-item">
            <h3 class="form-item-title">活動期間</h3>
            <input type="text" class="input">
        </div><!-- item -->
        <h2 class="entry-title">メンバー募集内容</h2>
        <form class="form">
            <h3 class="entry-title">募集役割</h3>
            <div class="item form-item">
                <h4 class="form-item-title">役割名</h4>
                <input type="text" class="input">
            </div><!-- item -->
            <div class="item form-item">
                <h4 class="form-item-title">参考ジョブ</h4>
                <input type="text" class="input">
            </div><!-- item -->
            <div class="item form-item">
                <h4 class="form-item-title">人数</h4>
                <input type="text" class="input input-large">
            </div><!-- item -->
            <div class="item form-item">
                <h4 class="form-item-title">備考</h4>
                <input type="text" class="input">
            </div><!-- item -->
            <div class="btn-wrap row flex-end-side flex-end-length">
                <button class="btn btn-next">次へ</button>
            </div><!-- btn-wrap -->
        </form><!-- form -->
    </div><!-- entry-body -->
</div><!-- entry -->
@endsection