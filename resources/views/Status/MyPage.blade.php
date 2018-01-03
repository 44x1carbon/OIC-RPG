@extends('Shared._DefaultLayout')

@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)

@section('header_title')
    ステータス
@endsection

@section('content')
    <?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
    <div class="mypage">
        <div class="mypage-profile">
            <h2 class="mypage-profile-name">氏名</h2>
            <div class="mypage-profile-left">
                <img src="../assets/images/job.png" alt="">
            </div><!--profile-left-->
            <div class="mypage-profile-right">
                <div class="mypage-profile-content">
                    <p>学籍番号</p>
                    <p>b9999</p>
                </div>
                <div class="mypage-profile-content">
                    <p>性別</p>
                    <p>男？</p>
                </div>
                <div class="mypage-profile-content">
                    <p>コース</p>
                    <p>ITスペシャリスト</p>
                    <div class="btn-wrap">
                        <button class="btn btn-small">変更</button>
                    </div>
                </div>
                <div class="mypage-profile-content">
                    <p>スキル</p>
                    <p>androidエンジニア</p>
                </div>
            </div><!--profile-right-->
            <div class="mypage-profile-bottom">
                <p>自己紹介</p>
            </div>
        </div><!--profile-->
        <div class="mypage-skill">
            <h2>スキル</h2>
            <ul class="mypage-skill-course-list">
                <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
                @foreach($fields as $field)
                    <li class="mypage-skill-course-item"><a>{{ $field->name }}</a></li>
                @endforeach
            </ul>
            <!-- mypage-skill-course-list -->
            <ul class="mypage-skill-list">
                <?php $skillStatusList = $skillStatusListVMHelper->groupByField($guildMember->skillStatusList())['it']; ?>
                <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
                @foreach($skillStatusList as $memberSkillStatus)
                    @if($memberSkillStatus->skillAcquisitionStatus->isLearned())
                        <li class="mypage-skill-item">
                            <p>{{ $memberSkillStatus->skill() }}</p>
                            <p>Lv.{{ $memberSkillStatus->possessionSkill->skillLevel }}</p>
                        </li>
                    @else
                        <li class="mypage-skill-item">
                            <p>{{ $memberSkillStatus->skill()->name }}</p>
                            <p>未取得</p>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- mypage-skill -->
        <div class="mypage-job">
            <h2>ジョブ</h2>
            <ul class="mypage-job-course-list">
                <li class="mypage-job-course-item"><a>IT</a></li>
                <li class="mypage-job-course-item"><a>ゲーム</a></li>
                <li class="mypage-job-course-item"><a>デザイン</a></li>
                <li class="mypage-job-course-item"><a>映像</a></li>
                <li class="mypage-job-course-item"><a>ビジネス</a></li>
            </ul>
            <ul class="mypage-job-list">
                <li class="mypage-job-item">
                    <a class="mypage-job-link">
                        <div class="mypage-job-pic-mask">イラスト</div>
                        <div class="mypage-job-content">
                            <p>ジョブ名</p>
                            <p>取得済</p>
                            <p>取得条件</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div><!--mypage-->
@endsection