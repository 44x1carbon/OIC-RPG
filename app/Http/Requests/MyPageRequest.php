<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/17
 * Time: 16:06
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MyPageRequest
 * @package App\Http\Requests
 */
class MyPageRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    private $options = ['it', 'game', 'movie', 'design'];

    public function selectSkillTab(): string
    {
        $inputKey = 'skillTab';
        if( $this->has($inputKey) && in_array($this->get($inputKey), $this->options) ) {
            return $this->get($inputKey);
        } else {
            return 'it';
        }
    }

    public function selectJobTab(): string
    {
        $inputKey = 'jobTab';
        if( $this->has($inputKey) && in_array($this->get($inputKey), $this->options) ) {
            return $this->get($inputKey);
        } else {
            return 'it';
        }
    }
}