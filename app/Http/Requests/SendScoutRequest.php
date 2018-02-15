<?php

namespace App\Http\Requests;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use Illuminate\Foundation\Http\FormRequest;

class SendScoutRequest extends FormRequest
{
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
        return [
            "partyId" => ["required"],
            "to" => ["required"],
            "message" => [],
        ];
    }

    public function to(): string
    {
        return $this->get('to');
    }

    public function partyId(): string
    {
        return $this->get('partyId');
    }

    public function message(): string
    {
        return $this->get('message') || '';
    }

    public function redirectTo(): string
    {
        if(!$this->has('redirectTo')) return $this->referer();
        return $this->get('redirectTo');
    }

    public function referer(): string
    {
        return $this->header('referer');
    }
}
