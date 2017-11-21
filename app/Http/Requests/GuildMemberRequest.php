<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/17
 * Time: 16:06
 */

namespace App\Http\Requests;


use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\Spec\GenderSpec;
use App\Domain\GuildMember\ValueObjects\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class GuildMemberRequest extends FormRequest
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
        Validator::extend('course_id_available', function($attribute, $value, $parameters, $validator){
            $course = $this->courseRepository->findById($value);
            return isset($course);
        });

        Validator::extend('gender_available', function($attribute, $value, $parameters, $validator){
            return GenderSpec::isAvailable($value);
        });

        return [
            'name' => [
                'required'
            ],
            'course_id' => [
                'required',
                'course_id_available',
            ],
            'gender' => [
                'required',
                'gender_available',
            ],
        ];
    }

    public function studentName(): String
    {
        $name = $this->request->get('name');
        return $name;
    }

    public function course(): ?Course
    {
        $id = $this->request->get('course_id');
        return $this->courseRepository->findById($id);
    }

    public function gender(): Gender
    {
        $gender = $this->request->get('gender');
        return new Gender($gender);
    }
}