@extends('Shared._DefaultLayout')

@section('header_title')
    申請者一覧
@endsection

<?php
    use App\Infrastracture\PartyParticipationRequest\PartyParticipationRequestViewModel;
?>


@section('content')
    <div class="background">
        <div class="layer layer1 board"></div>
    </div><!-- background -->
    @include('Guild.Party.Management._Navgation')
    <div class="party-management participation-request-list">
        <?php /* @var \App\Infrastracture\PartyParticipationRequest\PartyParticipationRequestViewModel  $participationRequest */ ?>
        <?php
            $participationRequestsByParty = collect($participationRequests)
                ->groupBy(function(PartyParticipationRequestViewModel $resuest) {
                    return $resuest->party()->productionIdea()->productionTheme;
                });
        ?>
        @foreach($participationRequestsByParty as $productionTheme => $requestsOfProductionTheme)
            <div class="managed-party-list panel">
                <div class="production-theme panel__header mod-inline mod-border">
                    {{ $productionTheme }}
                </div>
                <div class="panel__body mod-no-padding">
                    <?php
                        $participationRequestsByWantedRole = collect($requestsOfProductionTheme)
                            ->groupBy(function(PartyParticipationRequestViewModel $resuest) {
                                return $resuest->wantedRole()->roleName;
                            });
                    ?>
                    @foreach($participationRequestsByWantedRole as $roleName => $requestsOfRoleName)
                        <div class="by-wanted-role panel">
                            <div class="panel__header mod-yellow mod-inline">
                                {{ $roleName }}(残り{{ $requestsOfRoleName[0]->wantedRole()->assignableFrameNum }}枠)
                            </div>
                            <div class="requester-list panel__body mod-yellow">
                                @foreach($requestsOfRoleName as $participationRequest)
                                    <div class="requester">
                                        @include('Shared.Status._Profile', ['guildMember' => $participationRequest->applicant()])
                                        <div class="replay-actions flex-area">
                                            <form action="{{ route('do_reply', ['partyParticipationRequestId' => $participationRequest->id]) }}"
                                                  method="post">
                                                {{ csrf_field() }}
                                                <button class="btn mod-green"
                                                        type="submit"
                                                        name="reply"
                                                        value="{{ \App\Domain\PartyParticipationRequest\ValueObjects\Reply::PERMIT }}">
                                                    許可
                                                </button>
                                            </form>
                                            <form action="{{ route('do_reply', ['partyParticipationRequestId' => $participationRequest->id]) }}"
                                                  method="post">
                                                {{ csrf_field() }}
                                                <button class="btn mod-red mod-no-border"
                                                        type="submit"
                                                        name="reply"
                                                        value="{{ \App\Domain\PartyParticipationRequest\ValueObjects\Reply::REJECTION }}">
                                                    拒否
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection