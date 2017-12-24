@extends('Shared._DefaultLayout')

@section('header_title')
    Wanted
@endsection

@section('content')
<div class="background">
        <div class="layer layer1 board"></div>
    </div><!-- background -->
    <div class="entry layer2 entry-color">
        <div class="entry-header">
            <h2 class="entry-title">メンバー募集内容</h2>
        </div><!-- entry-header -->
        <div class="entry-body">
            <form class="form">
                <h3 class="entry-title">募集役割</h3>
                <div class="item form-item">
                    <h4 class="form-item-title">役割名</h4>
                    <input type="text" class="input" name=""><!-- 役割名 -->
                    <input type="checkbox">この役職に自分も所属する
                </div><!-- item -->
                <div class="item form-item">
                    <h4 class="form-item-title">参考ジョブ</h4>
                    <select name="" id=""><!-- 参考ジョブ -->
                        <option value="">androidエンジニア</option>
                    </select>
                </div><!-- item -->
                <div class="item form-item">
                    <h4 class="form-item-title">人数</h4>
                    <input type="number" class="input input-large" name=""><!--　人数 -->
                    <p>※自分も含む人数を記載してください</p>
                </div><!-- item -->
                <div class="item form-item">
                    <h4 class="form-item-title">備考</h4>
                    <input type="textarea" class="input" name=""><!-- 備考 -->
                </div><!-- item -->
                <div class="btn-wrap row flex-while flex-end-length">
                    <button class="btn btn-back" type="submit">戻る</button>
                    <button class="btn btn-next" type="submit">確認</button>
                    <button class="btn btn-add" type="submit">追加</button>
                </div><!-- btn-wrap -->
            </form><!-- form -->
        </div><!-- entry-body -->
    </div><!-- entry -->
@endsection