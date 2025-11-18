<?php

namespace App\Modules\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizationEmployeeRequest extends FormRequest
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
            'organization_employee_id' => 'required|exists:organization_employees,id',
            'name'   => 'nullable|string',
            'email'  => [
                'nullable',
                'string',
                'email',
                Rule::unique('organization_employees', 'email')
                    ->ignore($this->input('organization_employee_id')),
            ],
            'phone'  => [
                'nullable',
                'string',
                Rule::unique('organization_employees', 'phone')
                    ->ignore($this->input('organization_employee_id')),
            ],
            'address' => 'nullable|string',
            'image'   => 'nullable',
            'type'    => 'nullable|int',
        ];
    }
}
