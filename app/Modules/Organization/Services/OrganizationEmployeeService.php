<?php

namespace App\Modules\Organization\Services;

use App\Base\Response\DataFailed;
use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Modules\Organization\Http\Resources\Auth\LoginOrganizationEmployeeResource;
use App\Modules\Organization\Http\Resources\OrganizationEmployeeResource;
use App\Modules\Organization\Repositories\OrganizationEmployeeRepository;

use function Symfony\Component\String\s;

class OrganizationEmployeeService
{


public function loginOrganizationEmployee($dto): DataStatus
{
    $result = $this->organizationEmployeeRepository->loginOrganizationEmployee($dto);
    if (isset($result['success']) && $result['success'] === false) {
        return DataFailed::make(status:false, message:$result['massage']);
    }
    return new DataSuccess(data:
        new LoginOrganizationEmployeeResource($result['data']),message:$result['massage'], status:true
    );
}



    public function __construct(protected OrganizationEmployeeRepository $organizationEmployeeRepository) {}

    public function createOrganizationEmployee($dto): DataStatus
    {
        $organization_employee = $this->organizationEmployeeRepository->create($dto);
        return DataSuccess::make(resourceData: new OrganizationEmployeeResource($organization_employee), message: 'Organization employee created successfully');
    }

    public function updataOrganizationEmployee($dto): DataStatus
    {
        $organization_employee = $this->organizationEmployeeRepository->update($dto);
        return DataSuccess::make(resourceData: new OrganizationEmployeeResource($organization_employee), message: 'Organization employee updated successfully');
    }

    public function fetchOrganizationEmployee($dto): DataStatus
    {
        $organization_employees = $this->organizationEmployeeRepository->fetchOrganizationEmployee($dto);
        if (isset($dto->with_pagination) && $dto->with_pagination == 1) {
            $per_page = $dto->per_page ?? 10;
            $organization_employees = $organization_employees->paginate($per_page);
            $response = OrganizationEmployeeResource::collection($organization_employees)->response()->getData(true);
        } else {
            $response = OrganizationEmployeeResource::collection($organization_employees->get());
        }
        return new DataSuccess(data:$response,  status: true, message: 'Organization employees fetched successfully');
    }

    public function fetchOrganizationEmployeeDetails($dto): DataStatus
    {
        $organization_employee = $this->organizationEmployeeRepository->fetchOrganizationEmployeeDetails($dto);
        return DataSuccess::make(resourceData: new OrganizationEmployeeResource($organization_employee), message: 'Organization employee details fetched successfully');
    }

    public function deleteOrganizationEmployee($dto): DataStatus
    {
        $organization_employee = $this->organizationEmployeeRepository->delete($dto);
        return DataSuccess::make(message: 'Organization employee deleted successfully');
    }
}
