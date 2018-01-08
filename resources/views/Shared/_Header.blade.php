<header class="header">
    <div class="header-content left">
        <div class="header-btn circle float">
            <div class="btn btn-circle btn-gloss btn-head-nav font-white">
                Home
            </div>
        </div>
    </div>

    <div class="header-content center">
        <div class="header-title">
            {{ $slot }}{{-- ヘッダーに表示するタイトルが入る --}}
        </div>
    </div>

    <div class="header-content right">
        <div class="header-btn circle float">
            <div class="btn btn-circle btn-gloss btn-head-nav font-white">
                Menu
            </div>
        </div>
    </div>
</header>