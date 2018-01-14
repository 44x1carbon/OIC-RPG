@inject('jobStatusListVMHelper', App\Infrastracture\GuildMember\JobStatusListVMHelper)

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
                                <img src="{{ $memberJobStatus->job()->silhouettePath() }}" alt="">
                            @elseif($memberJobStatus->status->isLearned())
                                <img src="{{ $memberJobStatus->job()->characterImagePath() }}" alt="">
                            @else
                                <img src="{{ $memberJobStatus->job()->silhouettePath() }}" alt="">
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