@extends('Shared._DefaultLayout')

@section('header_title')
    AuthInfo
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 map"></div>
        <div class="layer layer2 chara"></div>
        <div class="layer layer3 opasity"></div>
    </div>
    <!-- background -->
    <div class="entry layer4">
        <div class="entry-header header-color">
            <h2 class="entry-title">ギルドメンバー登録</h2>
        </div>
        <!-- main-heading -->
        <div class="entry-body body-color">
            <form class="form entry-form" action="{{ route('do_sign_up_auth_info') }}" method="post">
                {{ csrf_field() }}
                <div class="item form-item">
                    <h3 class="form-item-title">メールアドレス</h3>
                    <input type="text" class="input" name="guild_member[mail_address]"><!--メールアドレス-->
                    @foreach($errors->get('guild_member.mail_address') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div><!-- item -->
                <div class="item form-item">
                    <h3 class="form-item-title">パスワード</h3>
                    <input type="password" class="input" name="guild_member[password]"><!--パスワード-->
                    @foreach($errors->get('guild_member.password') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div><!-- item -->
                <div class="btn-wrap row flex-end-side flex-end-length mt-auto">
                    <button class="btn mod-blue" type="submit">次へ</button>
                </div>
            </form>
            <!-- form -->
        </div>
        <!-- body -->
    </div>
    <!-- entry -->
@endsection
