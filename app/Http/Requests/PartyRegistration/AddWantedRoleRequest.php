<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 14:00
 */

namespace App\Http\Requests\PartyRegistration;

use Illuminate\Foundation\Http\FormRequest;

class AddWantedRoleRequest extends FormRequest
{
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
}