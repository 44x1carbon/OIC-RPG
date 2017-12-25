<?php

namespace App\Http\Requests\GuildMemberRegistration;

use App\Domain\GuildMember\Spec\GenderSpec;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        Validator::extend('gender_available', function($attribute, $value, $parameters, $validator){
            return GenderSpec::isAvailable($value);
        });

        return [
            'guild_member.name' => [
                'required'
            ],
            'guild_member.gender' => [
                'required',
                'gender_available',
            ],
        ];


    }

    public function messages()
    {
        return [
            'guild_member.name.required' => '名前は必須です。',
            'guild_member.gender.required' => '性別は必須です。',
            'guild_member.gender.gender_available' => '性別として指定できない値です。'
        ];
    }
}