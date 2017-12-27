<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/22
 * Time: 15:04
 */

namespace App\Http\Requests\PartyRegistration;

use App\Presentation\DTO\WantedRoleDto;
use Illuminate\Foundation\Http\FormRequest;

class WantedRequest extends FormRequest
{

    public function __construct(
        array $query = array(),
        array $request = array(),
        array $attributes = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function authorize()
    {
        // develop
        return true;

        //production
        return Auth::check();
    }

    public function rules()
    {
        return [
            'party.wantedRoleList'    => ['required', 'array'],
            'party.wantedRoleList.*.frameAmount' => ['required'],
            'party.wantedRoleList.*.remarks' => ['required'],
            'party.wantedRoleList.*.roleName' => ['required'],
            'party.wantedRoleList.*.referenceJobId' => ['required'],
        ];
    }

    public function wantedRoleDtos(): array
    {
        return array_map(function($w) {
            return new WantedRoleDto(
                $w['roleName'],
                $w['remarks'],
                $w['referenceJobId'],
                $w['frameAmount'],
                isset($w['managerAssigned'])? w['managerAssigned'] : false
            );
        }, $this->input('party.wantedRoleList'));
    }
}