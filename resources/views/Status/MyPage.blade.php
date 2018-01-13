@extends('Shared._DefaultLayout')

@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)
@inject('jobStatusListVMHelper', App\Infrastracture\GuildMember\JobStatusListVMHelper)

@section('header_title')
    ステータス
@endsection

@section('content')
    <?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
    <div class="mypage">
        <div class="mypage-profile">
            <h2 class="mypage-profile-name">{{ $guildMember->name }}</h2>
            <div class="mypage-profile-left">
                <img src="{{ $guildMember->favoriteJob()->characterImagePath() }}" alt="">
            </div><!--profile-left-->
            <div class="mypage-profile-right">
                <div class="mypage-profile-content">
                    <p>学籍番号</p>
                    <p>{{ $guildMember->studentNumber }}</p>
                </div>
                <div class="mypage-profile-content">
                    <p>性別</p>
                    <p>{{ $guildMember->gender->toJa() }}</p>
                </div>
                <div class="mypage-profile-content">
                    <p>コース</p>
                    <p>{{ $guildMember->course()->name }}</p>
                    <div class="btn-wrap">
                        <button class="btn btn-small">変更</button>
                    </div>
                </div>
                <div class="mypage-profile-content">
                    <p>スキル</p>
                    <?php $sortedSkill = $skillStatusListVMHelper->sortLevel($guildMember->skillStatusList()) ?>
                    <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
                    @foreach(array_slice($sortedSkill, 0, 5) as $memberSkillStatus)
                        <p>{{ $memberSkillStatus->skill()->name }}: Lv.{{ $memberSkillStatus->possessionSkill->skillLevel }}</p>
                    @endforeach
                </div>
            </div><!--profile-right-->
            <div class="mypage-profile-bottom">
                <p>自己紹介</p>
            </div>
        </div><!--profile-->
        <div class="mypage-skill" id="skill">
            <h2>スキル</h2>
            <ul class="mypage-skill-course-list">
                <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
                @foreach($fields as $field)
                    <li class="mypage-skill-course-item {{ $field->toKey() == $selectSkillTab? 'active' : '' }}">
                        <a href="{{ route('show_my_page') . '?skillTab='.$field->toKey().'&jobTab='.$selectJobTab.'#skill' }}">
                            {{ $field->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- mypage-skill-course-list -->
            <ul class="mypage-skill-list">
                <?php $skillStatusList = $skillStatusListVMHelper->groupByField($guildMember->skillStatusList())[$selectSkillTab]; ?>
                <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
                @foreach($skillStatusList as $memberSkillStatus)
                    @if($memberSkillStatus->skillAcquisitionStatus->isLearned())
                        <li class="mypage-skill-item">
                            <p>{{ $memberSkillStatus->skill()->name }}</p>
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
        <div class="mypage-job" id="job">
            <h2>ジョブ</h2>
            <ul class="mypage-job-course-list">
                <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
                @foreach($fields as $field)
                    <li class="mypage-job-course-item {{ $field->toKey() == $selectSkillTab? 'active' : '' }}">
                        <a href="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$field->toKey().'#job' }}">
                            {{ $field->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="mypage-job-list">
                <?php $jobStatusList = $jobStatusListVMHelper->groupByField($guildMember->jobStatusList())[$selectJobTab]; ?>
                <?php /* @var \App\Infrastracture\GuildMember\MemberJobStatusViewModel $memberJobStatus */ ?>
                @foreach($jobStatusList as $memberJobStatus)
                <li class="mypage-job-item">
                    @if($memberJobStatus->status->isGettable())
                        <a class="mypage-job-link">
                            <div class="mypage-job-pic-mask">
                                <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                            </div>
                            <div class="mypage-job-content">
                                <p>{{ $memberJobStatus->job()->name }}</p>
                                <p>習得可能</p>
                                <div>
                                    <form action="{{ route('do_get_job') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="jobId" value="{{ $memberJobStatus->job()->id }}">
                                        <input type="hidden" name="redirectUrl" value="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$selectJobTab.'#job' }}">
                                        <button type="submit">習得</button>
                                    </form>
                                </div>
                                <p>
                                    取得条件
                                    <?php /* @var \App\Infrastracture\Job\GetConditionViewModel $condition */ ?>
                                    @foreach($memberJobStatus->job()->getConditions() as $condition)
                                        <span>{{ $condition->skill()->name }}: Lv.{{ $condition->requiredLevel }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </a>
                    @elseif($memberJobStatus->status->isLearned())
                        <a class="mypage-job-link">
                            <div class="mypage-job-pic-mask">
                                <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                            </div>
                            <div class="mypage-job-content">
                                <p>{{ $memberJobStatus->job()->name }}</p>
                                <p>習得済み</p>
                                <div>
                                    <form action="{{ route('do_favorite_job') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="jobId" value="{{ $memberJobStatus->job()->id }}">
                                        <input type="hidden" name="redirectUrl" value="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$selectJobTab.'#job' }}">
                                        <button type="submit">お気に入り</button>
                                    </form>
                                </div>
                                <p>
                                    取得条件
                                    <?php /* @var \App\Infrastracture\Job\GetConditionViewModel $condition */ ?>
                                    @foreach($memberJobStatus->job()->getConditions() as $condition)
                                        <span>{{ $condition->skill()->name }}: Lv.{{ $condition->requiredLevel }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </a>
                    @else
                        <a class="mypage-job-link">
                            <div class="mypage-job-pic-mask">
                                <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                            </div>
                            <div class="mypage-job-content">
                                <p>{{ $memberJobStatus->job()->name }}</p>
                                <p>未習得</p>
                                <p>
                                    取得条件
                                    <?php /* @var \App\Infrastracture\Job\GetConditionViewModel $condition */ ?>
                                    @foreach($memberJobStatus->job()->getConditions() as $condition)
                                        <span>{{ $condition->skill()->name }}: Lv.{{ $condition->requiredLevel }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </a>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div><!--mypage-->
@endsection