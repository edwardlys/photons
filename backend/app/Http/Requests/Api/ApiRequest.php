<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    /** 
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $key => $value) {
            $errors[] = [
                'input' => $key,
                'message' => $value[0]
            ];
        }

        $response = response()->json([
            'code' => 'INVALID_INPUT',
            'message' => 'Input given does not conform with the required standard.',
            'data' => [],
            'errors' => $errors
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
