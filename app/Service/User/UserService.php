<?php

namespace App\Service\User;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Http\Enum\User\UserStatusEnum;
use App\Http\Enum\User\UserTypeEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Blog\Blog;
use App\Models\BlogCategory\BlogCategory;
use App\Models\BlogHashtag\BlogHashtag;
use App\Models\HeroSection\HeroSection;
use App\Models\Location\Location;
use App\Models\PropertyType\PropertyType;
use App\Models\User\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct() {}

    public function registerUser($data, $organization_id = null, $created_by = null): DataStatus
    {
        // dd($data['phone']);
        $registerUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'image' => uploadImage($data['image'], 'user', 'public'),
            'type' => UserTypeEnum::Client->value,
            'status' => UserStatusEnum::Pending->value,
            'organization_id' => $organization_id,
            'created_by' => $created_by
        ]);
        $registerUser->refresh();
        return DataSuccess::make(resourceData: new UserResource($registerUser), message: 'user created successfully');
    }

    public function loginUser($data, $organization_id = null): DataStatus
    {
        $credentials = $data['credentials'];
        $user = filter_var($credentials, FILTER_VALIDATE_EMAIL)
            ? User::where('email', $credentials)->first()
            : User::where('phone', $credentials)->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return DataStatus::make(success: false, message: 'The provided credentials are incorrect.');
        }
        $token = $user->createToken('user-token')->plainTextToken;
        $user['api_token'] = $token;
        return DataSuccess::make(resourceData: [
            new UserResource($user ),
        ]);
    }

    public function fetchDashboard($user): DataStatus
    {

    }
}
