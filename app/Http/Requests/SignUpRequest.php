<?php

namespace App\Http\Requests;

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Spec\GenderSpec;
use App\Domain\GuildMember\Spec\MailAddressSpec;
use App\Domain\GuildMember\Spec\PassWordSpec;
use App\Domain\GuildMember\Spec\StudentNumberSpec;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SignUpRequest extends FormRequest
{

    protected $courseRepository;

    public function __construct(
        array $query = array(),
        array $request = array(),
        array $attributes = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        $content = null,
        CourseRepositoryInterface $courseRepository
    )
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->courseRepository = $courseRepository;
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
        Validator::extend('student_number_format', function($attribute, $value, $parameters, $validator){
            return StudentNumberSpec::validateFormat($value);
        });
        Validator::extend('gender_available', function($attribute, $value, $parameters, $validator){
            return GenderSpec::isAvailable($value);
        });
        Validator::extend('mail_address_available', function($attribute, $value, $parameters, $validator){
            return MailAddressSpec::isAvailable($value);
        });
        Validator::extend('password_available', function($attribute, $value, $parameters, $validator){
           return PassWordSpec::isAvailable($value);
        });

        return [
            'student_number' => [
                'required',
                'string',
                'student_number_format',
            ],
            'name' => [
                'required'
            ],
            'course_id' => [
                'required'
            ],
            'gender' => [
                'required',
                'gender_available',
            ],
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

    public function studentNumber():string
    {
        return $this->request->get('student_number');
    }

    public function studentName(): string
    {
        return $this->request->get('name');
    }

    public function courseId(): string
    {
        return $this->request->get('course_id');

    }

    public function genderId(): string
    {
        return $this->request->get('gender');
    }

    public function mailAddress(): string
    {
        return  $this->request->get('mail_address');
    }

    public function password(): string
    {
        return $this->request->get('password');
    }

}
