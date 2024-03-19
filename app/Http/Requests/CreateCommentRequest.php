<?php

namespace App\Http\Requests;

use App\Enums\CommentType;
use App\Traits\JsonResponseTrait;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CreateCommentRequest extends FormRequest
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
            'content' => ['required', 'string'],
            'commentable_id' => ['required', 'numeric'],
            'commentable_type' => [new EnumValue(CommentType::class)],
            'users' => ['required', 'numeric', 'exists:App\Models\User,id'],

        ];
    }

    public function messages()
    {
        return [
            'content.required' => __('project.register.name.required'),
            'commentable_id.required' => __('project.register.describes.required'),
            'commentable_id.numeric' => __('project.register.user.numeric'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors));
    }
}
