<?php

namespace App\Http\Requests;

use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extend('reply_available', function($attribute, $value, $parameters, $validator){
            return in_array($value, Reply::STATUS_LIST);
        });

        return [
            'reply' => ['required', 'reply_available'],
        ];
    }

    public function reply(): string
    {
        return $this->get('reply');
    }
}
