@extends('Shared._DefaultLayout')

@section('header_title')
    ギルドメンバー検索
@endsection

@section('content')
    <div class="background">
        <div class="layer layer1 board"></div>
        <div class="layer layer2 opasity"></div>
    </div><!-- background -->
    <div class="search-options">
        <h2 class="search-options-title">検索条件</h2>
        <form action="{{ route('search_guild_member') }}" method="post" class="form">
            {{ csrf_field() }}
            <div class="form-item">
                <h3 class="form-item-title">ジョブ</h3>
                <select name="request_job_id" id="" class="input select">
                    <option value="" selected>選択してください</option>
                    <? /* @var \App\Infrastracture\Job\JobViewModel $job */ ?>
                    @foreach($allJob as $job)
                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-item">
                <h3 class="form-item-title">スキル</h3>
                @for ($i = 0; $i < 5; $i++)
                    <div class="row flex-center search-options-item">
                        <select name="request_skills[{{ $i }}][skill_id]" id="" class="input select">
                            <option value="" selected>選択してください</option>
                            <? /* @var \App\Infrastracture\Skill\SkillViewModel $skill */ ?>
                            @foreach($allSkill as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                        <p>Lv.</p>
                        <input type="number" min="0" max="99" name="request_skills[{{ $i }}][require_level]" class="input input-small">
                    </div>
                @endfor
                </div>
            <div class="btn-wrap row flex-center-length">
                <button type="submit" class="btn mod-green">検索</button>
            </div>
        </form>
    </div>
    <ul>
    <? /* @var \App\Infrastracture\GuildMember\GuildMemberViewModel $guildMember */ ?>
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
                <div class="form-item">
                  <p class="scout-user-name"><span>{{ $guildMember->name }}</span>さんをスカウトする</p>
                </div>
                <div class="form-item">
                    <h3 class="form-item-title">パーティー選択</h3>
                    <select class="select input">
                      <option>パーティー</option>
                        <? /* @var \App\Infrastracture\Party\PartyViewModel $party */ ?>
                        @foreach($managedPartyList as $party)
                            <option value="{{ $party->id }}">{{ $party->productionIdea()->productionTheme }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <h3 class="form-item-title">メッセージ</h3>
                    <textarea class="input textarea" row="5"></textarea>
                </div>
                <div class="btn-wrap row flex-while">
                    <button type="button" class="btn mod-red scout-modal-close">キャンセル</button>
                    <button type="submit" class="btn mod-blue">スカウト</button>
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
//                    var name = t.parentNode.parentNode.firstElementChild.children[0].firstElementChild.innerText
                    var scoutModal = t.parentNode.parentNode.lastElementChild
//                    scoutModal.lastElementChild.firstElementChild.children[0].firstElementChild.textContent = name;
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
