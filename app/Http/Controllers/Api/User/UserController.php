<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Service\User\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function registerUser(UserRegisterRequest $request)
    {
        $data = $request->validated();
        return $this->userService->registerUser($data, getOrganizationId())->response();
    }

    public function loginUser(UserLoginRequest $request)
    {
        $data = $request->validated();
        return $this->userService->loginUser($data, getOrganizationId())->response();
    }

}
