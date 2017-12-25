<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 13:49
 */

namespace App\Http\Requests\PartyRegistration;


use Illuminate\Foundation\Http\FormRequest;

class HandleWantedRequest extends FormRequest
{
    const ADD = 'add';
    const DONE = 'done';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // develop
        return true;

        //production
        return Auth::check();
    }

    public function rules()
    {
        return [];
    }

    public function isAdd(): bool
    {
        return $this->request->get('handler') === self::ADD;
    }

    public function isDone(): bool
    {
        return $this->request->get('handler') === self::DONE;
    }

    public function partyData()
    {
        return $this->request->get('party');
    }
}