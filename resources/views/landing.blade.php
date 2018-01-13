@extends('Shared._DefaultLayout')

@section('header_title')
    Creater's Guild
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 body-color"></div>
        <div class="layer layer2 poster"></div>
    </div><!-- background -->
    <div class="landing layer3">
        <div class="btn-wrap column flex-center">
          <a class="btn btn-large mod-blue marginb" href="{{ route('show_sign_in') }}">ログイン</a>
          <a class="btn btn-large mod-green" href="{{ route('show_sign_up_auth_info') }}">新規登録</a>
        </div>
    </div>
@endsection
