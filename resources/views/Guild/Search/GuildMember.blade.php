@extends('Shared._DefaultLayout')

@section('header_title')
    ギルドメンバー検索
@endsection

@section('content')
    <div class="search-options">
        <form action="{{ route('search_guild_member') }}" method="post">
            {{ csrf_field() }}
            <select name="request_job_id" id="">
                <option value="" selected>選択してください</option>
                <? /* @var \App\Infrastracture\Job\JobViewModel $job */ ?>
                @foreach($allJob as $job)
                    <option value="{{ $job->id }}">{{ $job->name }}</option>
                @endforeach
            </select>
            @for ($i = 0; $i < 5; $i++)
                <div>
                    <select name="request_skills[{{ $i }}][skill_id]" id="">
                        <option value="" selected>選択してください</option>
                        <? /* @var \App\Infrastracture\Skill\SkillViewModel $skill */ ?>
                        @foreach($allSkill as $skill)
                         <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" min="0" max="99" name="request_skills[{{ $i }}][require_level]">
                </div>
            @endfor
            <button type="submit">検索</button>
        </form>
    </div>
    @foreach($guildMembers as $guildMember)
        @include('Shared.Status._Profile', ['guildMember' => $guildMember])
    @endforeach
@endsection