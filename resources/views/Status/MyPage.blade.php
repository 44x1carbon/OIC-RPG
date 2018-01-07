@extends('Shared._DefaultLayout')

@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)
@inject('jobStatusListVMHelper', App\Infrastracture\GuildMember\JobStatusListVMHelper)

@section('header_title')
    ステータス
@endsection

@section('content')
    <?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
    <div class="mypage">
        <div class="mypage-profile mypage-content">
            <div class="profile-header {{ $guildMember->field()->toKey() }}">
                <h2 class="mypage-profile-name">{{ $guildMember->name }}</h2>
            </div>
            <div class="profile-left">
                <div class="fav-job-info">
                    <div class="fav-job-img">
                        <img src="{{ $guildMember->favoriteJob()->characterImagePath() }}" alt="">
                    </div>
                    <div class="fav-job-name {{ $guildMember->favoriteJob()->field()->toKey() }}">
                        {{ $guildMember->favoriteJob()->name }}
                    </div>
                </div>
            </div><!--profile-left-->
            <div class="profile-right">
                <div class="member-info">
                    <div class="member-info__content member-info__high-order-skills">
                        <div class="info-label">得意スキル</div>
                        <ul class="info-data">
                            <?php $sortedSkill = $skillStatusListVMHelper->sortLevel($guildMember->skillStatusList()) ?>
                            <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
                            @foreach(array_slice($sortedSkill, 0, 5) as $memberSkillStatus)
                                <li class="high-order-skill possession-skill">
                                    <span class="possession-skill__name">{{ $memberSkillStatus->skill()->name }}</span>
                                    <span class="possession-skill__level">Lv.<span class="level__value">{{ $memberSkillStatus->possessionSkill->skillLevel }}</span></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="member-info__content member-info__high-order-skills">
                        <div class="info-label">所属コース</div>
                        <div class="info-data">
                            {{ $guildMember->course()->name }}
                        </div>
                    </div>
                </div>
            </div><!--profile-right-->
            <div class="profile-bottom">
                <div class="member-info__content member-info__introduction">
                    <div class="info-label">自己紹介</div>
                    <div class="info-data">

                    </div>
                </div>
            </div>
        </div><!--profile-->

        <div class="mypage-skill mypage-content" id="skill">
            <div class="skill-header">
                スキル
            </div>
            <div class="skill-content">
                <div class="skill-tab">
                    <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
                    @foreach($fields as $field)
                        <a class="skill-tab-item {{ $field->toKey() == $selectSkillTab? 'active' : '' }}"
                            href="{{ route('show_my_page') . '?skillTab='.$field->toKey().'&jobTab='.$selectJobTab.'#skill' }}">
                            {{ $field->toShortJa() }}
                        </a>
                    @endforeach
                </div>

                <ul class="skill-list">
                    <?php $skillStatusList = $skillStatusListVMHelper->groupByField($guildMember->skillStatusList())[$selectSkillTab]; ?>
                    <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
                    @foreach($skillStatusList as $memberSkillStatus)
                        @if($memberSkillStatus->skillAcquisitionStatus->isLearned())
                            <li class="skill-item learned possession-skill">
                                <span class="possession-skill__name">{{ $memberSkillStatus->skill()->name }}</span>
                                <span class="possession-skill__level">Lv.<span class="level__value">{{ $memberSkillStatus->possessionSkill->skillLevel }}</span></span>
                            </li>
                        @else
                            <li class="skill-item not-learned possession-skill">
                                <span class="possession-skill__name">{{ $memberSkillStatus->skill()->name }}</span>
                                <span class="possession-skill__status">未取得</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
        <!-- mypage-skill -->
        <div class="mypage-job mypage-content" id="job">
            <div class="job-header">
                ジョブ
            </div>
            <div class="job-content">
                <div class="job-tab">
                    <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
                    @foreach($fields as $field)
                        <a class="job-tab-item {{ $field->toKey() == $selectJobTab? 'active' : '' }}"
                           href="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$field->toKey().'#job' }}">
                            {{ $field->toShortJa() }}
                        </a>
                    @endforeach
                </div>
                <ul class="job-list">
                    <?php $jobStatusList = $jobStatusListVMHelper->groupByField($guildMember->jobStatusList())[$selectJobTab]; ?>
                    <?php /* @var \App\Infrastracture\GuildMember\MemberJobStatusViewModel $memberJobStatus */ ?>
                    @foreach($jobStatusList as $memberJobStatus)
                        <li class="job-item">
                            <div class="job-img-area">
                                <div class="job-img">
                                    @if($memberJobStatus->status->isGettable())
                                        <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                                    @elseif($memberJobStatus->status->isLearned())
                                        <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                                    @else
                                        <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="job-info-area">
                                <div class="job-info">
                                    <div class="job-info__name">
                                        {{ $memberJobStatus->job()->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="job-status-area">
                                <div class="job-status">
                                    @if($memberJobStatus->status->isGettable())
                                        習得可能
                                    @elseif($memberJobStatus->job()->id == $guildMember->favoriteJob()->id)
                                        お気に入り
                                    @elseif($memberJobStatus->status->isLearned())
                                        習得済み
                                    @else
                                        未習得
                                    @endif
                                </div>
                            </div>
                            <div class="job-get-condition-area">
                                <div class="job-get-condition">
                                    <div class="job-get-condition__label">取得条件</div>
                                    <ul class="job-get-condition__list">
                                        <?php /* @var \App\Infrastracture\Job\GetConditionViewModel $condition */ ?>
                                        @foreach($memberJobStatus->job()->getConditions() as $condition)
                                            <li class="condtion possession-skill">
                                                <span class="possession-skill__name">{{ $condition->skill()->name }}</span>
                                                <span class="possession-skill__level">Lv.<span class="level__value">{{ $condition->requiredLevel }}</span></span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="job-action-area">
                                <div class="job-action">
                                    @if($memberJobStatus->status->isGettable())
                                        <form action="{{ route('do_get_job') }}" method="post"
                                              class="action__get">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="jobId" value="{{ $memberJobStatus->job()->id }}">
                                            <input type="hidden" name="redirectUrl" value="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$selectJobTab.'#job' }}">
                                            <button type="submit">習得</button>
                                        </form>
                                    @elseif($memberJobStatus->status->isLearned())
                                        <form action="{{ route('do_favorite_job') }}" method="post"
                                              class="action__favorite">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="jobId" value="{{ $memberJobStatus->job()->id }}">
                                            <input type="hidden" name="redirectUrl" value="{{ route('show_my_page') . '?skillTab='.$selectSkillTab.'&jobTab='.$selectJobTab.'#job' }}">
                                            <button type="submit" class="{{ $memberJobStatus->job()->id == $guildMember->favoriteJob()->id? 'disable' : '' }}">お気に入り</button>
                                        </form>
                                    @else
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div><!--mypage-->
@endsection