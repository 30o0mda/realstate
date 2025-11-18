<?php

namespace App\Modules\Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationEmployee\LoginOrganizationEmployeeRequest;
use App\Modules\Organization\DTOs\Auth\LoginOrganizationEmployeeDto;
use App\Modules\Organization\DTOs\OrganizationEmployee\OrganizationEmployeeDto;
use App\Modules\Organization\DTOs\OrganizationEmployee\OrganizationEmployeeFilterDto;
use App\Modules\Organization\Http\Requests\CreateOrganizationEmployeeRequest;
use App\Modules\Organization\Http\Requests\DeleteOrganizationEmployeeRequest;
use App\Modules\Organization\Http\Requests\FetchOrganizationEmployeeDetailsRequest;
use App\Modules\Organization\Http\Requests\FetchOrganizationEmployeeRequest;
use App\Modules\Organization\Http\Requests\UpdateOrganizationEmployeeRequest;
use App\Modules\Organization\Services\OrganizationEmployeeService;
use Termwind\Components\Ul;

use function Symfony\Component\String\s;

class OrganizationEmployeeController extends Controller
{

    protected $CourseService;

    public function __construct(protected OrganizationEmployeeService $organizationEmployeeService) {}

    public function createOrganizationEmployee(CreateOrganizationEmployeeRequest $request)
    {
        $dto = new OrganizationEmployeeDto(
            name: $request->name,
            email: $request->email,
            phone: $request->phone,
            address: $request->address,
            image: $request->image,
            password: $request->password,
            type: $request->type,
        );
        return $this->organizationEmployeeService->createOrganizationEmployee($dto)->response();
    }

    public function updataOrganizationEmployee(UpdateOrganizationEmployeeRequest $request)
    {
        $dto = new OrganizationEmployeeDto(
            name: $request->name,
            email: $request->email,
            phone: $request->phone,
            address: $request->address,
            image: $request->image,
            type: $request->type,
            is_master: $request->is_master,
            organization_employee_id: $request->organization_employee_id
        );
        return $this->organizationEmployeeService->updataOrganizationEmployee($dto)->response()->getData();
    }

    public function fetchOrganizationEmployee(FetchOrganizationEmployeeRequest $request)
    {
        $dto = new OrganizationEmployeeFilterDto(
            word: $request->word,
            with_pagination: $request->with_pagination,
            per_page: $request->per_page
        );
        return $this->organizationEmployeeService->fetchOrganizationEmployee($dto)->response()->getData();
    }

    public function fetchOrganizationEmployeeDetails(FetchOrganizationEmployeeDetailsRequest $request)
    {
        $dto = new OrganizationEmployeeDto(
            organization_employee_id: $request->organization_employee_id
        );
        return $this->organizationEmployeeService->fetchOrganizationEmployeeDetails($dto)->response()->getData();
    }

    public function deleteOrganizationEmployee(DeleteOrganizationEmployeeRequest $request)
    {
        $dto = new OrganizationEmployeeDto(
            organization_employee_id: $request->organization_employee_id
        );
        return $this->organizationEmployeeService->deleteOrganizationEmployee($dto)->response()->getData();
    }

    public function loginOrganizationEmployee(LoginOrganizationEmployeeRequest $request)
    {
        $dto = new LoginOrganizationEmployeeDto(
            $request->input('credentials'),
            $request->input('password')
        );
        return $this->organizationEmployeeService->loginOrganizationEmployee($dto)->response()->getData();
    }
}
