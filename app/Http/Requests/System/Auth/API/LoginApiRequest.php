<?php

namespace App\Http\Requests\System\Auth\API;

use Illuminate\Foundation\Http\FormRequest;

class LoginApiRequest extends FormRequest
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
            'msisdn' => ['required', 'regex:/^0[0-9]{5,10}$/'],
            'ip' => ['required'],
            'city_id' => ['required'],
            'password' => ['required'],
            'address' => ['nullable']
        ];
    }
}
