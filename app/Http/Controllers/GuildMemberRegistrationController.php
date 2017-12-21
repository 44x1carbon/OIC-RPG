<?php

namespace App\Http\Controllers;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Http\Requests\GuildMemberRegistration\AuthInfoRequest;
use App\Http\Requests\GuildMemberRegistration\ProfileRequest;
use App\Http\Requests\SignUpRequest;
use App\Presentation\GuildMemberFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuildMemberRegistrationController extends Controller
{
    public function showAuthInfo()
    {
        return view('signup.authinfo');
    }

    public function doAuthInfo(AuthInfoRequest $request)
    {
        $this->sessionSave($request->get('guild_member'), 'guild_member');
        return redirect()->route('show_sign_up_profile');
    }

    public function showProfile()
    {
        return view('signup.profile');
    }

    public function doProfile(ProfileRequest $request)
    {
        $this->sessionSave($request->get('guild_member'), 'guild_member');
        return redirect()->route('show_sign_up_school_info');
    }

    public function showSchoolInfo(CourseRepositoryInterface $courseRepository)
    {
        return view('signup.schoolinfo')
            ->with('session', session('guild_member'))
            ->with('courses', $courseRepository->all());
    }

    public function doSchoolInfo(SignUpRequest $request, GuildMemberFacade $guildMemberFacade)
    {
        $this->sessionSave($request->get('guild_member'), 'guild_member');

        $authData = $guildMemberFacade->registerMember(
            $request->studentNumber(),
            $request->studentName(),
            $request->courseId(),
            $request->genderId(),
            $request->mailAddress(),
            $request->password()
        );
        Auth::login($authData);
        return $authData;
    }

    private function makeValidator($data): \Illuminate\Validation\Validator
    {
        $rules = app(SignUpRequest::class)->rules();
        return Validator::make($data, $rules);
    }
}
