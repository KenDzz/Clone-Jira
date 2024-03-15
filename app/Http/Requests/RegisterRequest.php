<?php

namespace App\Http\Requests;

use App\Traits\JsonResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'permission' => ['required', 'numeric'],

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
            'permission.required' => __('auth.register.permission_id.required'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
