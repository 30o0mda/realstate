<?php

namespace App\Modules\Organization\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizationEmployeeRequest extends FormRequest
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
            'name' => 'required|',
            'email' => 'required|string|email|unique:organization_employees,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'image' => 'nullable',
            'password' => 'required|string',
            'type' => 'required|int',
        ];
    }
}
