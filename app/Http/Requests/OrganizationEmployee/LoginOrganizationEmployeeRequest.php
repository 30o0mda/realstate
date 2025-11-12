<?php

namespace App\Http\Requests\OrganizationEmployee;

use Illuminate\Foundation\Http\FormRequest;

class LoginOrganizationEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
        'credentials' => 'required|string',
        'password' => 'required|string',
        ];
    }
}

