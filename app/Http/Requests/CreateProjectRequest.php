<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use App\Traits\JsonResponseTrait;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateProjectRequest extends FormRequest
{

    use JsonResponseTrait;


    private $NEEDS_AUTHORIZATION = true;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->NEEDS_AUTHORIZATION;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => ['required', 'string'],
            'describes' => ['required', 'string'],
            'users.*' => ['required', 'numeric', 'exists:App\Models\User,id'],
            'status' => [new EnumValue(ProjectStatus::class)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('project.register.name.required'),
            'describes.required' => __('project.register.describes.required'),
            'users.required' => __('project.register.user.required'),
            'users.numeric' => __('project.register.user.numeric'),
            'users.exists' => __('project.register.users.exists'),
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
