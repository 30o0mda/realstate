<?php

namespace App\Http\Controllers\UserWebSite\OrganizationEmployee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\LoginOrganizationRequest;
use App\Http\Requests\OrganizationEmployee\LoginOrganizationEmployeeRequest;
use App\Service\Organization\OrganizationService;
use App\Service\OrganizationEmployee\OrganizationEmployeeService;
use Illuminate\Http\Request;

class OrganizationEmployeeController extends Controller
{

    public function __construct(protected OrganizationEmployeeService  $organizationService)
    {
    }

    public function loginOrganization(LoginOrganizationEmployeeRequest $request)
    {
        $data = $request->validated();
        return $this->organizationService->loginOrganization($data)->response();
    }



}
