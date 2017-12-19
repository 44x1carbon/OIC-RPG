@extends('Shared._DefaultLayout')

@section('header_title')
    SchoolInfo
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
            <form class="form" action="{{ route('do_sign_up_school_info') }}" method="post">
                {{ csrf_field() }}
                <div class="item form-item">
                    <h3 class="form-item-title">学籍番号</h3>
                    <input type="text" class="input" name=""><!-- 学籍番号 -->
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">学年</h3>
                        <select name="schoolyear"><!-- 学年 -->
                            <option value="1">1年</option>
                            <option value="2">2年</option>
                            <option value="3">3年</option>
                            <option value="4">4年</option>
                        </select>
                </div>
                <div class="item form-item">
                    <h3 class="form-item-title">コース</h3>
                    <select name="course"><!-- コース -->
                        <option value="">ITスペシャリスト先専攻</option>
                    </select>
                </div>
                <div class="btn-wrap row flex-end-length flex-center-length">
                    <button class="btn btn-register" type="submit">登録</button>
                </div>
            </form><!-- form -->
        </div><!-- body -->
    </div><!-- entry -->
@endsection
