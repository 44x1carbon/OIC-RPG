@extends('Shared._DefaultLayout')

@inject('skillStatusListVMHelper', App\Infrastracture\GuildMember\SkillStatusListVMHelper)
@inject('jobStatusListVMHelper', App\Infrastracture\GuildMember\JobStatusListVMHelper)

@section('header_title')
    ステータス
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1" style="background-color: #333"></div>
    </div>
    <?php /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
    <div class="mypage">
        @include('Shared.Status._Profile', ['guildMember' => $guildMember])
        @include('Shared.Status._Skill', ['guildMember' => $guildMember])
        @include('Shared.Status._Job', ['guildMember' => $guildMember])
    </div><!--mypage-->
@endsection