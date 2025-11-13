<?php

namespace App\Http\Controllers\Api\UserDashboard;

use App\Http\Controllers\Controller;
use App\Service\User\UserService;
use App\Service\UserDashboard\UserDashboardService;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __construct(protected UserDashboardService $userDashboardService) {}

    public function fetchDashboard( )
    {
        return  $this->userDashboardService->fetchDashboard()->response();
    }
}
