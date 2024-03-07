<?php

namespace App\Http\Requests;

use App\Traits\JsonErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class CreateTaskRequest extends FormRequest
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
            'project_id' => ['required', 'numeric'],
            'priority_id' => ['required', 'numeric'],
            'users.*' => ['required', 'numeric'],
            'datetimes' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => __('task.create.category_id.required'),
            'level_id.required' => __('task.create.level_id.required'),
            'name.required' => __('task.create.name.required'),
            'describes.required' => __('task.create.describes.required'),
            'project_id.required' => __('task.create.project_id.required'),
            'priority_id.required' => __('task.create.priority_id.required'),
            'datetimes.required' => __('task.create.datetimes.required'),

            'category_id.numeric' => __('task.create.category_id.required'),
            'level_id.numeric' => __('task.create.level_id.required'),
            'name.numeric' => __('task.create.name.required'),
            'describes.numeric' => __('task.create.describes.required'),
            'project_id.numeric' => __('task.create.project_id.required'),
            'priority_id.numeric' => __('task.create.priority_id.required'),
            'users.numeric' => __('task.create.users.numeric'),
            'datetimes.numeric' => __('task.create.datetimes.numeric'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->result($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false));
    }
}
