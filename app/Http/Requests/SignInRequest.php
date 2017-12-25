<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/28
 * Time: 11:38
 */

namespace App\Http\Requests;


use App\Domain\GuildMember\Spec\MailAddressSpec;
use App\Domain\GuildMember\Spec\PassWordSpec;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SignInRequest extends FormRequest
{
    protected $guildMemberRepository;

    public function __construct(
        array $query = array(),
        array $request = array(),
        array $attributes = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        $content = null
    )
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('mail_address_available', function($attribute, $value, $parameters, $validator){
            return MailAddressSpec::isAvailable($value);
        });
        Validator::extend('password_available', function($attribute, $value, $parameters, $validator){
            return PassWordSpec::isAvailable($value);
        });

        return [
            'mail_address' => [
                'required',
                'mail_address_available'
            ],
            'password' => [
                'required',
                'password_available',
            ],
        ];
    }

    public function mailAddress(): string
    {
        return $this->request->get('mail_address');
    }

    public function password(): string
    {
        return $this->request->get('password');
    }


}