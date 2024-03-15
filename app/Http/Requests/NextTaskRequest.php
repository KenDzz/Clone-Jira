<?php

namespace App\Http\Requests;

use App\Traits\JsonResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class NextTaskRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'level_id' => ['required', 'numeric'],
            'type' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [

            'id.required' => __('task.update.id.required'),
            'level_id.required' => __('task.update.level_id.required'),
            'level_id.numeric' => __('task.update.level_id.required'),
            'type.required' => __('task.update.type.required'),
            'type.boolean' => __('task.update.type.boolean'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
