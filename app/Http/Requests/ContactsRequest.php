<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'POST') {
            return [
                'name' => 'required|string|max:25',
                'number' => 'required|string|regex:/^[0-9]{11}$/',



            ];
        }
        
        if ($method == 'PUT' || $method == 'PATCH') {
            return [
                'name' => 'sometimes|string|max:25',
                'number' => 'sometimes|string|regex:/^[0-9]{11}$/',

            ];
        }

        return [];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'the name field must be a string.',
            'name.max' => 'The name may not be greater than 25 characters.',
            'number.required' => 'The number field is required.',
            'number.string' => 'the number field must be a string.',
            'number.regex' => 'The number field must be a valid phone number with no special characters.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'errors' => $errors,
        ], 422));
    }

}
