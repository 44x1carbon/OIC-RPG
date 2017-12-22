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
                    <input type="text" class="input" name="student_number"><!-- 学籍番号 -->
                    @foreach($errors->get('guild_member.student_number') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div>

                <div class="item form-item">
                    <h3 class="form-item-title">コース</h3>
                    <select name="course_id"><!-- コース -->
                        @foreach($courses as $course)
                            <option value="{{ $course->id() }}">{{ $course->courseName() }}</option>
                        @endforeach
                    </select>
                    @foreach($errors->get('guild_member.course_id') as $message)
                        <p class="error form-error">※{{ $message }}</p>
                    @endforeach
                </div>
                <div class="btn-wrap row flex-end-length flex-center-length">
                    <button class="btn btn-register" type="submit">登録</button>
                </div>

                {{-- 全データを一度に送るためにセッションから持ってくる --}}
                <input type="hidden" name="name" value="{{ $session['name'] }}">
                <input type="hidden" name="mail_address" value="{{ $session['mail_address'] }}">
                <input type="hidden" name="password" value="{{ $session['password'] }}">
                <input type="hidden" name="gender" value="{{ $session['gender'] }}">
                <input type="hidden" name="introduction" value="{{ $session['introduction'] }}">
            </form><!-- form -->
        </div><!-- body -->
    </div><!-- entry -->
@endsection
