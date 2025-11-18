<?php

namespace App\Modules\Organization\Repositories;

use App\Base\Response\DataStatus;
use App\Modules\Organization\Models\organizationEmployee\OrganizationEmployee;
use Illuminate\Support\Facades\Hash;

class OrganizationEmployeeRepository
{

    public function loginOrganizationEmployee($dto)
    {
        try {
            $organization_employee = OrganizationEmployee::where('email', $dto->credentials)->first();
            if (!$organization_employee || !Hash::check($dto->password, $organization_employee->password)) {
                return [
                    'success' => false,
                    'message' => 'The provided credentials are incorrect.',
                ];
            }
            $organization_employee['token'] = $organization_employee->createToken('organization-employee-token')->plainTextToken;
            $data = [
                'success' => true,
                'massage' => 'Organization employee logged in successfully',
                'data' => $organization_employee,
            ];
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create($dto)
    {
        try {
            $data = $dto->toArray();
            $data['image'] = uploadImage($data['image'], 'Organization_Employee', 'public');
            $organization_employee = OrganizationEmployee::create($data);
            return $organization_employee;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($dto)
    {
        try {
            $organization_employee = OrganizationEmployee::find($dto->organization_employee_id);
            $data = $dto->toArray();
            $data['image'] = uploadImage($data['image'], 'Organization_Employee', 'public');
            $organization_employee->update($data);
            return $organization_employee;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fetchOrganizationEmployee($dto)
    {
        try {
            $query = OrganizationEmployee::query();
            if (!empty($dto->word)) {
                $query->where('name','like', '%' . $dto->word . '%');
            }
            $organization_employee = $query->latest();
            return $organization_employee;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fetchOrganizationEmployeeDetails($dto)
    {
        try {
            $organization_employee = OrganizationEmployee::find($dto->organization_employee_id);
            return $organization_employee;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($dto)
    {
        try {
            $organization_employee = OrganizationEmployee::find($dto->organization_employee_id);
            $organization_employee->delete();
            return $organization_employee;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
