<header class="header">
    <div class="header-content left">
        <div class="header-btn circle float">
            <a class="btn btn-circle btn-gloss btn-head-nav font-white" href="{{ route('top') }}">
                Home
            </a>
        </div>
    </div>

    <div class="header-content center">
        <div class="header-title">
            {{ $slot }}{{-- ヘッダーに表示するタイトルが入る --}}
        </div>
    </div>

    <div class="header-content right">
        <div class="header-btn circle float">
            <div class="menu-btn btn btn-circle btn-gloss btn-head-nav font-white">
                Menu
            </div>
        </div>
    </div>
</header>