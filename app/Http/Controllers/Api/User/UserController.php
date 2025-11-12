<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Service\User\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function registerUser(UserRegisterRequest $request)
    {
        $data = $request->validated();
        return $this->userService->registerUser($data)->response();
    }



}
