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
    <ul>
    @foreach($guildMembers as $guildMember)
      <li>
        @include('Shared.Status._Profile', ['guildMember' => $guildMember])
        <div class="btn-wrap row flex-center-length btn-wrap-scout">
            <button type="button" class="btn mod-green btn-scout">スカウトする</button>
        </div>
        <div class="scout-modal">
            <div class="scout-modal-header">
                <h2 class="scout-modal-title">スカウト</h2>
            </div>
            <form class="scout-modal-inner form">
                <div class="form-item ">
                    <h3 class="form-item-title">パーティー選択</h3>
                    <select class="select input">
                      <option>パーティー</option>
                    </select>
                </div>
                <div class="form-item">
                    <h3 class="form-item-title">スカウト文</h3>
                    <textarea class="input textarea" row="5"></textarea>
                </div>
                <div class="btn-wrap row flex-while">
                    <button type="button" class="btn mod-red scout-modal-close">キャンセル</button>
                    <button type="submit" class="btn mod-blue">送信する</button>
                </div>
            </form>
        </div>
      </li>
    @endforeach
    </ul>
    <script type="text/javascript">
        window.onload = function () {
            var scoutBtn = document.getElementsByClassName('btn-scout')
            document.addEventListener('click',function(e){
                var t=e.target;
                if(t.classList.contains("btn-scout")) {
                    var name = t.parentNode.parentNode.firstElementChild.children[0].firstElementChild.innerText
                    console.log(name)
                    var scoutModal = t.parentNode.parentNode.lastElementChild
                    scoutModal.classList.add("show");
                }
            })
            document.addEventListener('click',function(e){
                var t=e.target;
                if(t.classList.contains("scout-modal-close")) {
                    var scoutModal = t.parentNode.parentNode.parentNode
                    scoutModal.classList.remove("show");
                }
            })

        };
    </script>
@endsection
