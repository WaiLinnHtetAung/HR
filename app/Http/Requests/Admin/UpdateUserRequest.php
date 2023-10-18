<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user')->id;
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
            'employee_id' => 'required',
            'phone' => 'required|min:9|max:11|unique:users,phone,' . $id,
            'nrc' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'dep_id' => 'required',
            'position_id' => 'required',
            'join_date' => 'required',
        ];

    }
}
