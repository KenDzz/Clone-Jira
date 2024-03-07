<?php

namespace App\Http\Requests;

use App\Traits\JsonErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UpdateTaskRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'level_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'describes' => ['required', 'string'],
            'id' => ['required', 'numeric'],
            'priority_id' => ['required', 'numeric'],
            'users.*' => ['required', 'numeric'],
            'datetimes' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => __('task.update.category_id.required'),
            'level_id.required' => __('task.update.level_id.required'),
            'name.required' => __('task.update.name.required'),
            'describes.required' => __('task.update.describes.required'),
            'id.required' => __('task.update.id.required'),
            'priority_id.required' => __('task.update.priority_id.required'),
            'datetimes.required' => __('task.update.datetimes.required'),
            'category_id.numeric' => __('task.update.category_id.required'),
            'level_id.numeric' => __('task.update.level_id.required'),
            'name.numeric' => __('task.update.name.required'),
            'describes.numeric' => __('task.update.describes.required'),
            'id.numeric' => __('task.update.id.required'),
            'priority_id.numeric' => __('task.update.priority_id.required'),
            'users.numeric' => __('task.update.users.numeric'),
            'datetimes.numeric' => __('task.update.datetimes.numeric'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->result($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false));
    }
}
