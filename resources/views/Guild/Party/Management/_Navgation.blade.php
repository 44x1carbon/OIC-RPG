<nav class="party-management-nav">
  <a href="{{ route('holding_party') }}" class="party-management-nav-link {{ $name == 'holding'? 'active' : '' }}">管理</a>
  <a href="{{ route('entry_party') }}" class="party-management-nav-link {{ $name == 'entry'? 'active' : '' }}">参加</a>
  <a href="{{ route('applying_party') }}" class="party-management-nav-link {{ $name == 'applying'? 'active' : '' }}">申請中</a>
</nav>
