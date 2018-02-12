@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)

<div class="mypage-profile mypage-content">
    <div class="profile-header {{ $guildMember->field()->toKey() }}">
        <h2 class="mypage-profile-name">{{ $guildMember->name }}</h2>
    </div>
    <div class="profile-left">
        <div class="fav-job-info">
            <div class="fav-job-img" style="background-image: url('{{ $guildMember->favoriteJob()->characterImagePath() }}')">
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

