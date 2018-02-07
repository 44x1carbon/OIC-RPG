<div class="menu">
    <div class="panel">
        <div class="panel__header mod-border">ギルド</div>
        <div class="menu-links panel__body mod-no-padding flex-area">
            <a href="{{ route('show_party_registration_production_idea') }}" class="menu__link">パーティー作成</a>
            <a href="{{ route('search_party') }}" class="menu__link">パーティー検索</a>
            <a href="#" class="menu__link">パーティー管理</a>
            {{--<a href="{{ route('') }}" class="menu__link">パーティー管理</a>--}}
        </div>
    </div>
    <div class="panel">
        <div class="panel__header mod-border">パーティー管理</div>
        <div class="menu-links panel__body mod-no-padding flex-area">
            <a href="{{ route('holding_party') }}" class="menu__link">管理</a>
            <a href="{{ route('entry_party') }}" class="menu__link">参加</a>
            <a href="{{ route('applying_party') }}" class="menu__link">申請中</a>
        </div>
    </div>
    <div class="panel">
        <div class="panel__header mod-border">参加申請</div>
        <div class="menu-links panel__body mod-no-padding flex-area">
            <a href="{{ route('shoe_participation_request_list') }}" class="menu__link">申請者一覧</a>
        </div>
    </div>
    <div class="panel">
        <div class="panel__header mod-border">ステータス</div>
        <div class="menu-links panel__body mod-no-padding flex-area">
            <a href="{{ route('show_my_page') }}" class="menu__link">プロフィール</a>
            <a href="{{ route('show_my_page').'#skill' }}" class="menu__link">スキル</a>
            <a href="{{ route('show_my_page').'#job' }}" class="menu__link">ジョブ</a>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        let scoutModal = document.getElementsByClassName('js-scout-modal-show')[0]
        document.getElementsByClassName('menu-btn')[0].onclick = () => {
            menu.classList.add('show')
        }

        menu.onclick = () => {
            menu.classList.remove('show')
        }
    }
</script>
