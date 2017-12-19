@extends('Shared._DefaultLayout')

@section('header_title')
    ProductionIdea
@endsection

@section('content')
    <h1>ProductionIdea</h1>
    <div class="background">
        <div class="layer layer1 board"></div>
    </div><!-- background -->
    <div class="entry layer2 entry-color">
        <div class="entry-header">
            <h2 class="entry-title">制作内容</h2>
        </div><!-- entry-header -->
        <div class="entry-body">
            <form class="form">
                <div class="item form-item">
                    <h3 class="form-item-title">テーマ</h3>
                    <input type="text" class="input" name=""><!-- テーマ -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">種類</h3>
                    <select name="production-type" id="">
                        <option value="0">システム</option>
                        <option value="1">映像</option>
                    </select><!-- 種類 -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">説明</h3>
                    <input type="textarea" class="input input-large" name=""><!-- 説明 -->
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">活動期間</h3>
                    <input type="date" class="input" name=""><!-- 活動期間 -->
                </div><!-- item -->
                <div class="btn-wrap row flex-end-side flex-end-length">
                    <button class="btn btn-next" type="submit">次へ</button>
                </div><!-- btn-wrap -->
            </form><!-- form -->
        </div><!-- entry-body -->
    </div><!-- entry -->
@endsection