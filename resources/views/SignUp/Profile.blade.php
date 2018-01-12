<?php
    use App\Domain\GuildMember\ValueObjects\Gender;
?>

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
            <form class="form entry-form" action="{{ route('do_sign_up_profile') }}" method="post">
                {{ csrf_field() }}
                <div class="item form-item">
                    <h3 class="form-item-title">名前</h3>
                    <input type="text" class="input" placeholder="(例)山田 太郎" name="guild_member[name]"><!-- 名前 -->
                    @foreach($errors->get('guild_member.name') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">性別</h3>
                    <div class="radio-wrap row"><!-- 性別 -->
                        <div class="radio-group">
                            <label class="radio-name" for="man">男</label>
                            <input type="radio" class="radio-btn-large" name="guild_member[gender]" value="{{ Gender::MALE  }}" id="man" checked>
                        </div>
                        <div class="radio-group">
                            <label class="radio-name" for="woman">女</label>
                            <input type="radio" class="radio-btn-large" name="guild_member[gender]" value="{{ Gender::FEMALE }}" id="woman">
                        </div>
                    </div>
                    @foreach($errors->get('guild_member.gender') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">自己紹介</h3>
                    <textarea class="input textarea" name="guild_member[introduction]" col="10" row="5"></textarea><!-- 自己紹介 -->
                </div>
                <div class="btn-wrap row flex-while flex-end-length mt-auto">
                    <button class="btn btn-back" type="submit" value="">戻る</button><!-- AuthInfo -->
                    <button class="btn btn-next" type="submit">次へ</button>
                </div>
            </form><!-- form -->
        </div><!-- body -->
    </div><!-- entry -->
@endsection
