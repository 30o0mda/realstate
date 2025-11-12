<?php

namespace App\Service\OrganizationEmployee;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Http\Resources\OrganizationEmployee\OrganizationEmployeeResource;

use App\Models\OrganizationEmployee\OrganizationEmployee;
use Illuminate\Support\Facades\Hash;

class OrganizationEmployeeService
{
     public function __construct()
    {
    }

   public function loginOrganization($data): DataStatus
    {
        $organizationEmployee = OrganizationEmployee::where('email', $data['credentials'])
        ->orWhere('phone', $data['credentials'])
        ->first();
        if (!$organizationEmployee || !Hash::check($data['password'], $organizationEmployee->password)) {
            return DataStatus::make(success: false, message: 'The provided credentials are incorrect.');
        }
        $token = $organizationEmployee->createToken('organization-token')->plainTextToken;
        return DataSuccess::make(resourceData: [
        new OrganizationEmployeeResource($organizationEmployee, $token)
        ], message: 'Organization logged in successfully');
    }

}
