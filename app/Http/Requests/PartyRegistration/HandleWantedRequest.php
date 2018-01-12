<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 13:49
 */

namespace App\Http\Requests\PartyRegistration;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('required_manager_assigned', function($attribute, $value, $parameters, $validator){
            $exsitManagerAssineds = array_filter($value, function($v) {
                return array_key_exists('managerAssigned', $v);
            });
            return count($exsitManagerAssineds) > 0;
        });

        return [
            'party.wantedRoleList'    => array_merge(['required', 'array'], $this->onlyDone(['required_manager_assigned']) ),
            'party.wantedRoleList.*.frameAmount' => $this->onlyDone(['required']),
            'party.wantedRoleList.*.remarks' => $this->onlyDone([]),
            'party.wantedRoleList.*.roleName' => $this->onlyDone(['required']),
            'party.wantedRoleList.*.referenceJobId' => $this->onlyDone(['required']),
        ];
    }

    public function messages()
    {
        $messages = [
            'party.wantedRoleList.required_manager_assigned' => '自分の所属する役割を選択してください',
        ];

        foreach ($this->input('party.wantedRoleList'  ) as $index => $value) {
            $messages["party.wantedRoleList.$index.frameAmount.required"] = '募集人数は必須です';
            $messages["party.wantedRoleList.$index.roleName.required"] = '募集役割名は必須です';
            $messages["party.wantedRoleList.$index.referenceJobId.required"] = '参考ジョブは必須です';
        }

        return $messages;
    }

    private function onlyDone($rules): array
    {
        if(!$this->isDone()) return [];
        if(is_array($rules)) return $rules;
        return [$rules];
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