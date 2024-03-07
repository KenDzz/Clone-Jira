<?php

namespace App\Http\Requests;

use App\Traits\JsonErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'permission_id' => ['required', 'numeric'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('auth.register.name.required'),
            'password.required' => __('auth.register.password.required'),
            'password.min' => __('auth.register.password.min'),
            'email.unique' => __('auth.register.email.unique'),
            'email.required' => __('auth.register.email.required'),
            'permission_id.required' => __('auth.register.permission_id.required'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->result($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false));
    }
}
