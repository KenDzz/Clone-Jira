<?php

namespace App\Http\Requests;

use App\Traits\JsonErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ImageUploadRequest extends FormRequest
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
            'upload' => 'required|image|max:10000|mimes:jpeg,png,jpg'
        ];
    }

    public function messages()
    {
        return [
            'upload.required' => __('upload.image.required'),
            'upload.max' => __('upload.image.max'),
            'upload.mimes' => __('upload.image.mimes'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException($this->result($errors, Response::HTTP_UNPROCESSABLE_ENTITY, false));
    }
}
