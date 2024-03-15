<?php

namespace App\Http\Requests;

use App\Enums\PriorityType;
use App\Traits\JsonResponseTrait;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class CreateTaskRequest extends FormRequest
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
            'category_id' => ['required', 'numeric' , 'exists:App\Models\Category,id'],
            'level_id' => ['required', 'numeric' , 'exists:App\Models\Level,id'],
            'name' => ['required', 'string'],
            'describes' => ['required', 'string'],
            'project_id' => ['required', 'numeric', 'exists:App\Models\Project,id'],
            'priority' => [new EnumValue(PriorityType::class)],
            'users.*' => ['required', 'numeric', 'exists:App\Models\User,id'],
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
            'datetimes.required' => __('task.create.datetimes.required'),

            'category_id.numeric' => __('task.create.category_id.required'),
            'level_id.numeric' => __('task.create.level_id.required'),
            'name.numeric' => __('task.create.name.required'),
            'describes.numeric' => __('task.create.describes.required'),
            'project_id.numeric' => __('task.create.project_id.required'),
            'users.numeric' => __('task.create.users.numeric'),
            'datetimes.numeric' => __('task.create.datetimes.numeric'),

            'category_id.exists' => __('task.create.category_id.exists'),
            'level_id.exists' => __('task.create.level_id.exists'),
            'project_id.exists' => __('task.create.project_id.exists'),
            'users.exists' => __('task.create.users.exists'),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
