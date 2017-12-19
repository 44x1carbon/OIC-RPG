@extends('Shared._DefaultLayout')

@section('header_title')
    Profile
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 map"></div>
        <div class="layer layer2 chara"></div>
        <div class="layer layer3 opasity"></div>
    </div><!-- background -->
    <div class="entry layer4">
        <div class="entry-header header-color">
            <h2 class="entry-title">ギルドメンバー登録</h2>
        </div><!-- main-heading -->
        <div class="entry-body body-color">
            <form class="form" action="">
                <div class="item form-item">
                    <h3 class="form-item-title">名前</h3>
                    <input type="text" class="input" placeholder="(例)山田 太郎" name=""><!-- 名前 -->
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">性別</h3>
                    <div class="radio-wrap"><!-- 性別 -->
                        <input type="radio" name="sex" value="" id="man" checked>
                        <label class="radio-name" for="man">男</label>
                        <input type="radio" name="sex" value="" id="woman">
                        <label class="radio-name" for="woman">女</label>
                    </div>
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">自己紹介</h3>
                    <input type="textarea" class="input" name="" col="10" row="5"><!-- 自己紹介 -->
                </div>
                <div class="btn-wrap row flex-while flex-end-length">
                    <button class="btn btn-back" type="submit" value="">戻る</button><!-- AuthInfo -->
                    <button class="btn btn-next" type="submit">次へ</button>
                </div>
            </form><!-- form -->
        </div><!-- body -->
    </div><!-- entry -->
@endsection
