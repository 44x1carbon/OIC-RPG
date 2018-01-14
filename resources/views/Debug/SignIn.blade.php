<form action="/debug/sign_in" method="post">
    {{ csrf_field() }}
    <ul>
        <?php /* @var \App\Domain\GuildMember\GuildMember $guildMember */ ?>
        @foreach($guildMembers as $guildMember)
        <li>
            {{ $guildMember->studentName() }}
            <button type="submit" name="address" value="{{ $guildMember->mailAddress()->address() }}">ログイン</button>
        </li>
        @endforeach
    </ul>
</form>