@extends('Shared._DefaultLayout')

@section('header_title')
    パーティー登録
@endsection

@section('content')
<div class="background">
        <div class="layer layer1 board"></div>
    </div><!-- background -->
    <div class="entry layer2 party-entry">
        <div class="entry-header">
            <h2 class="entry-title">メンバー募集内容</h2>
        </div><!-- entry-header -->
        <div class="entry-body body-color party-entry-body">
            <form class="form" action="{{ route('do_party_registration_wanted') }}" method="post">
                {{ csrf_field() }}
                <?php /* @var \App\Presentation\DTO\WantedRoleDto $wantedRole */ ?>
                @foreach($session->wantedRoleDtos as $index => $wantedRole)
                    <h3 class="entry-title">募集役割{{$index+1}}</h3>
                    <div class="item form-item">
                        <h4 class="form-item-title">役割名</h4>
                        <input type="text" class="input" name="party[wantedRoleList][{{$index}}][roleName]" value="{{ $wantedRole->roleName }}"><!-- 役割名 -->
                        <label class="label party-entry-organizer"><input type="checkbox" name="party[wantedRoleList][{{$index}}][managerAssigned]" {{ $wantedRole->managerAssigned()? 'checked' : '' }}>この役職に自分も所属する</label>
                        @foreach($errors->get("party.wantedRoleList.$index.roleName") as $message)
                            <p class="form-error">{{ $message }}</p>
                        @endforeach
                    </div><!-- item -->
                    <div class="item form-item">
                        <h4 class="form-item-title">参考ジョブ</h4>
                        <select id="" class="input" name="party[wantedRoleList][{{$index}}][referenceJobId]"><!-- 参考ジョブ -->
                            <?php /* @var \App\Domain\Job\Job $job */ ?>
                            @foreach($allJob as $job)
                                <option value="{{ $job->jobId()->code() }}" {{ $wantedRole->referenceJobId() == $job->jobId()->code()? 'selected' : '' }}>{{ $job->jobName() }}</option>
                            @endforeach
                        </select>
                        @foreach($errors->get("party.wantedRoleList.$index.referenceJobId") as $message)
                            <p class="form-error">{{ $message }}</p>
                        @endforeach
                    </div><!-- item -->
                    <div class="item form-item">
                        <h4 class="form-item-title">人数</h4>
                        <input type="number" class="input" name="party[wantedRoleList][{{$index}}][frameAmount]" value="{{ $wantedRole->frameAmount() }}"><!--　人数 -->
                        <p class="party-entry-organizer">※自分も含む人数を記載してください</p>
                        @foreach($errors->get("party.wantedRoleList.$index.frameAmount") as $message)
                            <p class="form-error">{{ $message }}</p>
                        @endforeach
                    </div><!-- item -->
                    <div class="item form-item">
                        <h4 class="form-item-title">備考</h4>
                        <textarea class="input textarea" name="party[wantedRoleList][{{$index}}][remarks]">{{ $wantedRole->remarks() }}</textarea><!-- 備考 -->
                        @foreach($errors->get("party.wantedRoleList.$index.remarks") as $message)
                            <p class="form-error">{{ $message }}</p>
                        @endforeach
                    </div><!-- item -->
                @endforeach

                @foreach($errors->get("party.wantedRoleList") as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach

                <div class="btn-wrap row flex-while flex-end-length">
                    <button class="btn mod-gray" type="submit">戻る</button>

                    <button class="btn mod-orange"
                            type="submit"
                            name="handler"
                            value="{{ \App\Http\Requests\PartyRegistration\HandleWantedRequest::DONE }}">
                        確認
                    </button>

                    <button class="btn btn-add mod-blue"
                            type="submit"
                            name="handler"
                            value="{{ \App\Http\Requests\PartyRegistration\HandleWantedRequest::ADD }}">
                        追加
                    </button>
                </div><!-- btn-wrap -->
            </form><!-- form -->
        </div><!-- entry-body -->
    </div><!-- entry -->
@endsection
