<?php

namespace App\Modules\Organization\DTOs\Auth;

use Illuminate\Support\Facades\Hash;

class LoginOrganizationEmployeeDto

{
    public  $credentials;
    public string $password;
    // public string $email;
    // public string $phone;





    public function __construct(
        string $credentials,
        string $password,

    ) {
        $this->fromArray([
            'credentials' => $credentials,
            'password' => $password
        ]);
    }

    public function fromArray($data)
    {
        if (filter_var($data['credentials'], FILTER_VALIDATE_EMAIL)) {
            $this->credentials = $data['credentials'];
        } else {
            $this->credentials = $data['credentials'];
        }
        $this->password = $data['password'];
    }

    public function toArray()
    {
        return [
            'credentials' => $this->credentials,
            'password' => $this->password
        ];
    }
}
