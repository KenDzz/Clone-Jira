<?php

namespace App\Http\Requests;

use App\Traits\JsonErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UpdateProjectRequest extends FormRequest
{

    use JsonErrorResponseTrait;


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
            'is_exist' => ['required', 'boolean'],
            'users.*' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('project.update.name.required'),
            'describes.required' => __('project.update.describes.required'),
            'name.max' => __('project.update.name.max'),
            'is_exist.required' => __('project.update.isExist.required'),
            'users.required' => __('project.register.user.required'),
            'users.numeric' => __('project.register.user.numeric'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->result($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false));
    }
}
