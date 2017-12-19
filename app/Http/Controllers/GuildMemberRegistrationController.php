<?php

namespace App\Http\Controllers;

class GuildMemberRegistrationController extends Controller
{
    public function showAuthInfo()
    {
        return view('signup.authinfo');
    }

    public function doAuthInfo()
    {
    }

    public function showProfile()
    {
        return view('signup.profile');
    }

    public function doProfile()
    {

    }

    public function showSchoolInfo()
    {
        return view('signup.schoolinfo');
    }

    public function doSchoolInfo()
    {

    }
}
