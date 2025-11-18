<?php

namespace App\Modules\Organization\DTOs\OrganizationEmployee;

use Illuminate\Support\Facades\Hash;

class OrganizationEmployeeDto

{
    public ?string $name;
    public ?string $email;
    public ?string $phone;
    public ?string $address;
    public ?string $image;
    public ?int $type;
    public ?string $password;
    public ?int $organization_id;

    public ?int $organization_employee_id;

    public ?int $is_master;



    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $phone = null,
        ?string $address = null,
        ?string $image = null,
        ?string $password = null,
        ?int $type = null,
        ?int $organization_employee_id = null,
        ?int $is_master = null

    ){
        $this->fromArray([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'image' => $image,
            'password' => $password,
            'type' => $type,
            'organization_employee_id' => $organization_employee_id,
            'is_master' => $is_master


        ]);
    }

    public function fromArray($data){

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->address = $data['address'];
        $this->image = $data['image'];
        $this->type = $data['type'];
        $this->password = Hash::make($data['password']);
        $this->organization_id = getOrganizationId();
        $this->organization_employee_id = $data['organization_employee_id'];
        $this->is_master = $data['is_master'];

    }

    public function toArray(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image,
            'type' => $this->type,
            'password' => $this->password,
            'organization_id' => $this->organization_id,
            'is_master' => $this->is_master
        ];
    }
}
