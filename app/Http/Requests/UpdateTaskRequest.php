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

class UpdateTaskRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'priority' => [new EnumValue(PriorityType::class)],
            'users.*' => ['required', 'numeric', 'exists:App\Models\User,id'],
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
            'category_id.exists' => __('task.create.category_id.exists'),
            'level_id.exists' => __('task.create.level_id.exists'),
            'users.exists' => __('task.create.users.exists'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
