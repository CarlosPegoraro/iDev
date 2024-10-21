<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
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
        return [
            'email' => 'email|required',
            'password' => 'required',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function () {
            if ($this->input('email') == null) {
                return response()->json(['error' => 'email not defined']);
            }
            if ($this->input('password') == null) {
                return response()->json(['error' => 'password not defined']);
            }
        });
    }
}
