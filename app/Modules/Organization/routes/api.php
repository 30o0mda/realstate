<?php

use App\Modules\Organization\Http\Controllers\OrganizationEmployeeController;
use Illuminate\Support\Facades\Route;


Route::prefix("organization")->group(function () {
        Route::post('/organization_employee_login', [OrganizationEmployeeController::class, 'loginOrganizationEmployee']);
    Route::middleware("auth:employee")->group(function () {
        Route::post('/create_organization_employee', [OrganizationEmployeeController::class, 'createOrganizationEmployee']);
        Route::post('/update_organization_employee', [OrganizationEmployeeController::class, 'updataOrganizationEmployee']);
        Route::post('/fetch_organization_employee', [OrganizationEmployeeController::class, 'fetchOrganizationEmployee']);
        Route::get('/fetch_organization_employee_details', [OrganizationEmployeeController::class, 'fetchOrganizationEmployeeDetails']);
        Route::post('/delete_organization_employee', [OrganizationEmployeeController::class, 'deleteOrganizationEmployee']);
    });
});
