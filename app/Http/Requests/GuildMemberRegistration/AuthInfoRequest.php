<?php

namespace App\Http\Requests\GuildMemberRegistration;

use App\Domain\GuildMember\Spec\MailAddressSpec;
use App\Domain\GuildMember\Spec\PassWordSpec;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class AuthInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        Validator::extend('mail_address_available', function($attribute, $value, $parameters, $validator){
            return MailAddressSpec::isAvailable($value);
        });
        Validator::extend('password_available', function($attribute, $value, $parameters, $validator){
            return PassWordSpec::isAvailable($value);
        });

        return [
            'guild_member.mail_address' => [
                'required',
                'mail_address_available'
            ],
            'guild_member.password' => [
                'required',
                'password_available',
            ],
        ];
    }

    public function messages()
    {
        return [
            'guild_member.mail_address.required' => 'メールアドレスは必須です。',
            'guild_member.mail_address.mail_address_available' => '利用できるのは、OICのメールアドレスのみです。',
            'guild_member.password.required' => 'パスワードは必須です。',
            'guild_member.password.password_available' => 'パスワードとして利用できるのは英数字のみです。'
        ];
    }
}