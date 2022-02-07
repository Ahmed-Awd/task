<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|max:200|email|unique:users,email',
            'password' => 'required|string|confirmed||min:6|max:25',
            "type" => "required|in:admin,guest"
        ];
    }
}
