<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteJobRequest extends FormRequest
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
            'redirectUrl' => ['string', 'required'],
            'jobId' => ['string', 'required']
        ];
    }

    /**
     * @return string
     */
    public function redirectUrl(): string
    {
        return $this->get('redirectUrl');
    }

    /**
     * @return string
     */
    public function jobId(): string
    {
        return $this->get('jobId');
    }
}
