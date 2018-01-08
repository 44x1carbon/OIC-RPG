<?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
<form action="/debug/learn_skill" method="post">
    {{ csrf_field() }}
    <?php /* @var \App\Infrastracture\GuildMember\MemberSkillStatusViewModel $memberSkillStatus */ ?>
    @foreach($guildMember->skillStatusList() as $memberSkillStatus)
        <div>
            {{ $memberSkillStatus->skill()->name }}
            <?php $nowLevel = $memberSkillStatus->skillAcquisitionStatus->isLearned()? $memberSkillStatus->possessionSkill->skillLevel : 0; ?>
            <input type="number" name="update[{{ $memberSkillStatus->skill()->id }}]" value="{{ $nowLevel }}">
        </div>
    @endforeach
    <button type="submit">変更</button>
</form>