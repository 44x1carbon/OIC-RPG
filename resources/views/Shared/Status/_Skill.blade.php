@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)

<div class="mypage-skill mypage-content" id="skill">
    <div class="skill-header">
        スキル
    </div>
    <div class="skill-content">
        <div class="skill-tab">
            <?php /* @var \App\Infrastracture\Field\FieldViewModel $field */ ?>
            @foreach($fields as $field)
                <a class="skill-tab-item {{ $field->toKey() == $selectSkillTab? 'active' : '' }}"
                   href="{{ '?skillTab='.$field->toKey().'&jobTab='.$selectJobTab.'#skill' }}">
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
                        <span class="possession-skill__level">未取得</span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

</div>
<!-- mypage-skill -->